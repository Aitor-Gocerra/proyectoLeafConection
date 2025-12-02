<?php

require_once __DIR__ . '/../modelos/Palabra.php';

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
        $this->palabrasList = $this->palabraMod->listarpalabras();
    }

    public function gestionarPalabras()
    {
        $this->vista = 'gestionarPalabras';
        $this->listarPalabras();
        return ['palabras' => $this->palabrasList, 'mensaje' => $this->mensaje];
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

        $this->gestionarPalabras();
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

        $this->gestionarPalabras();
    }
}
?>