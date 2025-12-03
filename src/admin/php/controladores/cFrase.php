<?php

require_once __DIR__ . '/../modelos/mFrase.php';

class CFrase
{

    private $fraseMod;
    public $mensaje;
    public $frasesList;
    public $vista;

    public function __construct()
    {
        $this->fraseMod = new Frase();
        $this->vista = '';
    }


    public function listarFrases()
    {
        $this->frasesList = $this->fraseMod->listarFrases();
    }

    public function gestionarFrases()
    {
        $this->vista = 'gestionarFrases';
        $this->listarFrases();
        return ['frases' => $this->frasesList, 'mensaje' => $this->mensaje];
    }

    public function buscarFrases()
    {
        $this->vista = 'gestionarFrases';
        
        $buscar = $_GET['buscar'] ?? '';
        
        if (empty($buscar)) {
            $this->mensaje = "Por favor, introduce un término de búsqueda.";
            return ['mensaje' => $this->mensaje];
        }

        // Buscar frases
        $resultados = $this->fraseMod->buscarFrases($buscar);

        return [
            'resultadosBusqueda' => $resultados,
            'mensaje' => $this->mensaje
        ];
    }

    public function guardarNuevaFrase()
    {
        // 1. Recoger y sanitizar datos del formulario
        $frase = $_POST['frase'] ?? '';
        $palabraFaltante = $_POST['palabraFaltante'] ?? '';
        $pistaInicial = $_POST['pista'][0] ?? '';

        // 2. Validación básica
        if (empty($frase) || empty($palabraFaltante) || empty($pistaInicial)) {
            $this->mensaje = "Error: Faltan campos obligatorios para la frase.";
            $this->gestionarFrases();
            return;
        }

        $idFrase = $this->fraseMod->crearFraseYpista(
            $frase,
            $palabraFaltante,
            $pistaInicial
        );

        if ($idFrase) {
            // Añadir pistas adicionales si existen
            if (isset($_POST['pista']) && count($_POST['pista']) > 1) {
                for ($i = 1; $i < count($_POST['pista']); $i++) {
                    if (!empty($_POST['pista'][$i])) {
                        $this->fraseMod->anadirPista($idFrase, $_POST['pista'][$i]);
                    }
                }
            }
            $this->mensaje = "Frase guardada correctamente con ID: " . $idFrase;
        } else {
            $this->mensaje = "Error al guardar la frase. Revise logs de base de datos.";
        }

        $this->gestionarFrases();
    }

    public function anadirPistaAdicional()
    {
        $idFrase = $_POST['idFrase'] ?? null;
        $nuevaPista = $_POST['nuevaPista'] ?? '';

        if (empty($idFrase) || empty($nuevaPista)) {
            $this->mensaje = "Error: ID de frase o nueva pista faltante.";
            return;
        }

        // Llama al método del modelo para añadir la pista
        $exito = $this->fraseMod->anadirPista($idFrase, $nuevaPista);

        if ($exito) {
            $this->mensaje = "Pista añadida correctamente a la Frase ID: " . $idFrase;
        } else {
            $this->mensaje = "Error al añadir la pista.";
        }
    }

    public function eliminarFrase()
    {
        $idFrase = $_REQUEST['idFrase'] ?? null;

        if (empty($idFrase)) {
            $this->mensaje = "Error: No se proporcionó ID para eliminar.";
            $this->gestionarFrases();
            return;
        }

        $exito = $this->fraseMod->eliminarFrase($idFrase);

        if ($exito) {
            $this->mensaje = "Frase ID: {$idFrase} eliminada correctamente.";
        } else {
            $this->mensaje = "Error al eliminar la frase.";
        }

        $this->gestionarFrases();
    }
}
?>