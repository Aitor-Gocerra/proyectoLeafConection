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
        
        return [
            'resultadosBusqueda' => $resultados,
            'mensaje' => $this->mensaje
        ];
    }
    public function guardarNuevaPalabra()
    {
        // 1. Recoger y sanitizar datos del formulario
        $palabra = $_POST['palabra'] ?? '';
        $palabraCorrecta = $_POST['palabraCorrecta'] ?? '';
        $pista = $_POST['pista'][0] ?? '';

        // 2. Validación básica
        if (empty($palabra) || empty($palabraCorrecta) || empty($pista)) {
            $this->mensaje = "Error: Faltan campos obligatorios para la palabra.";
            $this->gestionarPalabras();
            return;
        }

        $idPalabra = $this->palabraMod->crearpalabraYpista(
            $palabra,
            $palabraCorrecta,
            $pista
        );

        if ($idPalabra) {
            $this->mensaje = "palabra guardada correctamente con ID: " . $idPalabra;
        } else {
            $this->mensaje = "Error al guardar la palabra. Revise logs de base de datos.";
        }

        return $this->gestionarPalabras();
    }

    public function actualizarPalabra() {

        if (empty($_POST['idPalabra']) || empty($_POST['palabra']) || empty($_POST['palabraCorrecta'])) {
            $this->mensaje = "Error: rellena todos los campos.";
            return $this->gestionarPalabras();
        }

        $id              = $_POST['idPalabra'];
        $palabra         = trim($_POST['palabra']);
        $palabraCorrecta = trim($_POST['palabraCorrecta']);

        $ok = $this->palabraMod->actualizarPalabra($id, $palabra, $palabraCorrecta);

        if ($ok) {
            $this->mensaje = "Palabra actualizada correctamente.";
        } else {
            $this->mensaje = "Error al actualizar la palabra.";
        }

        return $this->gestionarPalabras();
    }
    /* public function anadirPistaAdicional() {
        $idPalabra = $_POST['idPalabra'] ?? null;
        $nuevaPista = $_POST['nuevaPista'] ?? '';

        if (empty($idPalabra) || empty($nuevaPista)) {
            $this->mensaje = "Error: ID de palabra o nueva pista faltante.";
            return;
        }

        // Llama al método del modelo para añadir la pista
        $exito = $this->palabraMod->anadirPista($idPalabra, $nuevaPista);

        if ($exito) {
            $this->mensaje = "Pista añadida correctamente a la palabra ID: " . $idPalabra;
        } else {
            $this->mensaje = "Error al añadir la pista.";
        }
    } */

    public function eliminarPalabra()
    {
        $idPalabra = $_REQUEST['idPalabra'] ?? null;

        if (empty($idPalabra)) {
            $this->mensaje = "Error: No se proporcionó ID para eliminar.";
            $this->gestionarPalabras();
            return;
        }

        $exito = $this->palabraMod->eliminarpalabra($idPalabra);

        if ($exito) {
            $this->mensaje = "palabra ID: {$idPalabra} eliminada correctamente.";
        } else {
            $this->mensaje = "Error al eliminar la palabra.";
        }

        return $this->gestionarPalabras();
    }
}
?>