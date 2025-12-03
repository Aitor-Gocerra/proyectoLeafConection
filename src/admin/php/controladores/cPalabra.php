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

        // 2. Validación básica
        if (empty($palabra) || empty($definicion)) {
            $this->mensaje = "Error: Faltan campos obligatorios para la palabra.";
            return $this->gestionarPalabras();
        }

        $idPalabra = $this->palabraMod->crearPalabra(
            $palabra,
            $definicion,
            $fecha
        );

        if ($idPalabra) {
            // Recorremos el array de pistas (esto guarda la pista 1, la 2, la 3, etc.)
            foreach ($pistas as $pistaPalabra) {
                // Solo guardamos si el texto no está vacío
                if (!empty(trim($pistaPalabra))) {
                    // Llamada al segundo método del modelo: AÑADIR PISTA
                    $this->palabraMod->anadirPista($idPalabra, $pistaPalabra);
                }
            }
            $this->mensaje = "Palabra guardada correctamente con ID: " . $idPalabra;
        } else {
            $this->mensaje = "Error al guardar la palabra. Revise logs de base de datos.";
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

        $ok = $this->palabraMod->actualizarPalabra($id, $palabra, $definicion);

        if ($ok) {
            $this->mensaje = "Palabra actualizada correctamente.";
        } else {
            $this->mensaje = "Error al actualizar la palabra.";
        }

        return $this->gestionarPalabras();
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
}
?>