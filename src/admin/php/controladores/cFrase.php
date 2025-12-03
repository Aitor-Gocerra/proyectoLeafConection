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

        // También cargar las 10 últimas frases para que no desaparezcan
        $this->listarFrases();

        return [
            'resultadosBusqueda' => $resultados,
            'frases' => $this->frasesList,
            'mensaje' => $this->mensaje
        ];
    }

    public function guardarNuevaFrase()
    {
        // 1. Recoger y sanitizar datos del formulario
        $frase = $_POST['frase'] ?? '';
        $palabraFaltante = $_POST['palabraFaltante'] ?? '';
        $fecha = $_POST['fecha'] ?? null;

        $pistaInicial = $_POST['pista'] ?? [];

        // 2. Validación básica
        if (empty($frase) || empty($palabraFaltante) || empty($pistaInicial)) {
            $this->mensaje = "Error: Faltan campos obligatorios para la frase.";
            $this->gestionarFrases();
            return;
        }

        $idFrase = $this->fraseMod->crearFrase(
            $frase,
            $palabraFaltante,
            $fecha
        );

        if ($idFrase) {
            // Recorremos el array de pistas (esto guarda la pista 1, la 2, la 3, etc.)
            foreach ($pistaInicial as $pistaTexto) {
                // Solo guardamos si el texto no está vacío
                if (!empty(trim($pistaTexto))) {
                    // Llamada al método del modelo: AÑADIR PISTA
                    $this->fraseMod->anadirPista($idFrase, $pistaTexto);
                }
            }
            $this->mensaje = "Frase guardada correctamente con ID: " . $idFrase;
        } else {
            $this->mensaje = "Error al guardar la frase. Revise logs de base de datos.";
        }

        return $this->gestionarFrases();
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
    public function editarFrase()
    {
        $this->vista = 'gestionarFrases';
        $idFrase = $_GET['idFrase'] ?? null;

        $fraseEditar = null;
        if ($idFrase) {
            $fraseEditar = $this->fraseMod->obtenerFrase($idFrase);
        }

        $this->listarFrases();
        return [
            'frases' => $this->frasesList,
            'mensaje' => $this->mensaje,
            'fraseEditar' => $fraseEditar
        ];
    }

    public function eliminarFrase()
    {
        $idFrase = $_REQUEST['idFrase'] ?? null;

        if (empty($idFrase)) {
            $this->mensaje = "No se proporcionó ID para eliminar";
            return $this->gestionarFrases();
        }

        $exito = $this->fraseMod->eliminarFrase($idFrase);

        if ($exito) {
            $this->mensaje = "Frase ID: {$idFrase} eliminada correctamente.";
        } else {
            $this->mensaje = "Error al eliminar la frase.";
        }
        return $this->gestionarFrases();
    }
}
?>