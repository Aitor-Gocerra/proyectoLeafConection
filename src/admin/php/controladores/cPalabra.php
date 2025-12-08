<?php

require_once __DIR__ . '/../modelos/mPalabra.php';

class CPalabra
{

    private $palabraMod;
    public $mensaje;
    public $palabrasList;
    public $vista;

    public function __construct()
    {
        $this->palabraMod = new Palabra();
        $this->vista = '';
    }


    public function listarPalabras()
    {
        $this->palabrasList = $this->palabraMod->listarPalabras();
    }

    public function gestionarPalabras()
    {
        $this->vista = 'gestionarPalabras';
        $this->listarPalabras();
        return ['palabras' => $this->palabrasList, 'mensaje' => $this->mensaje];
    }

    public function buscarPalabras()
    {
        $this->vista = 'gestionarPalabras';

        $buscar = $_GET['buscar'] ?? '';

        if (empty($buscar)) {
            $this->mensaje = "Por favor, introduce un término de búsqueda.";
            return ['mensaje' => $this->mensaje];
        }

        // Buscar palabras
        $resultados = $this->palabraMod->buscarPalabras($buscar);

        // También cargar las 10 últimas palabras para que no desaparezcan
        $this->listarPalabras();

        return [
            'resultadosBusqueda' => $resultados,
            'palabras' => $this->palabrasList,
            'mensaje' => $this->mensaje
        ];
    }
    public function guardarNuevaPalabra()
    {
        // 1. Recoger y sanitizar datos del formulario
        $palabra = $_POST['palabra'] ?? '';
        $definicion = $_POST['definicion'] ?? '';
        $fecha = $_POST['fecha'] ?? null;

        $pistas = $_POST['pista'] ?? [];

        // Validación básica
        if (empty($palabra) || empty($definicion)) {
            $this->mensaje = "Error: Faltan campos obligatorios para la palabra.";
            return $this->gestionarPalabras();
        }

        // Iniciar transacción
        try {
            // Iniciamos la transacción ANTES de crear la palabra
            $this->palabraMod->iniciarTransaccion();

            $idPalabra = $this->palabraMod->crearPalabra(
                $palabra,
                $definicion,
                $fecha
            );

            if (!$idPalabra) {
                throw new Exception("Error al crear la palabra en la base de datos.");
            }

            foreach ($pistas as $pistaPalabra) {
                if (!empty(trim($pistaPalabra))) {
                    $resultado = $this->palabraMod->anadirPista($idPalabra, $pistaPalabra);

                    if (!$resultado) {
                        throw new Exception("Error al añadir la pista: " . $pistaPalabra);
                    }
                }
            }

            //Si todo fue bien, confirmamos la transacción
            $this->palabraMod->confirmarTransaccion();
            $this->mensaje = "Palabra guardada correctamente con ID: " . $idPalabra;

        } catch (Exception $e) {
            // Si hubo algún error, revertimos todos los cambios (ROLLBACK)
            $this->palabraMod->revertirTransaccion();
            $this->mensaje = "Error: No se pudo guardar la palabra. " . $e->getMessage();
        }

        return $this->gestionarPalabras();
    }

    public function actualizarPalabra()
    {

        if (empty($_POST['idPalabra']) || empty($_POST['palabra']) || empty($_POST['definicion'])) {
            $this->mensaje = "Error: rellena todos los campos.";
            return $this->gestionarPalabras();
        }

        $id = $_POST['idPalabra'];
        $palabra = trim($_POST['palabra']);
        $definicion = trim($_POST['definicion']);
        $fecha = $_POST['fecha'];

        $ok = $this->palabraMod->actualizarPalabra($id, $palabra, $definicion, $fecha);

        if ($ok) {
            $this->mensaje = "Palabra actualizada correctamente.";
        } else {
            $this->mensaje = "Error al actualizar la palabra.";
        }

        return $this->gestionarPalabras();
    }

    public function editarPalabra()
    {
        $this->vista = 'gestionarPalabras';
        $idPalabra = $_GET['idPalabra'] ?? null;
        $usarModal = isset($_GET['modal']) && $_GET['modal'] == '1';

        $palabraEditar = null;
        if ($idPalabra) {
            $palabraEditar = $this->palabraMod->obtenerPalabra($idPalabra);
        }

        $this->listarPalabras();
        return [
            'palabras' => $this->palabrasList,
            'mensaje' => $this->mensaje,
            'palabraEditar' => $palabraEditar,
            'usarModal' => $usarModal
        ];
    }

    public function eliminarPalabra()
    {
        $idPalabra = $_REQUEST['idPalabra'] ?? null;

        if (empty($idPalabra)) {
            $this->mensaje = "No se proporcionó ID para eliminar";
            return $this->gestionarPalabras();
        }

        $exito = $this->palabraMod->eliminarpalabra($idPalabra);

        if ($exito) {
            $this->mensaje = "Palabra ID: {$idPalabra} eliminada correctamente.";
        } else {
            $this->mensaje = "Error al eliminar la palabra.";
        }
        return $this->gestionarPalabras();
    }

    public function actualizarFechas()
    {
        $exito = $this->palabraMod->actualizarFechas();

        if ($exito) {
            $mensaje = "Fechas actualizadas correctamente";
            header("Location: index.php?c=Palabra&m=gestionarPalabras&success=" . $mensaje);
        } else {
            $mensaje = "Error al actualizar fechas";
            header("Location: index.php?c=Palabra&m=gestionarPalabras&error=" . $mensaje);
        }
    }
}
?>