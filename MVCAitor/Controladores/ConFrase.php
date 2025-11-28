<?php

    require_once __DIR__ . '/../Modelos/Frase.php';


    class ConFrase {

        private $fraseMod; // Instancia del modelo de Frase
        public $mensaje;    // Para almacenar mensajes de éxito/error al usuario
        public $frasesList; // Para almacenar la lista de frases a mostrar en una vista
        
        // Inyección de la conexión a la base de datos (PDO)
        public function __construct(PDO $db) {
            // Inicializa la instancia del modelo, pasándole la conexión $db
            $this->fraseMod = new Frase($db);
        }

        
        public function listarFrases() {

            $this->frasesList = $this->fraseMod->listarFrases();
        }

        public function guardarNuevaFrase() {
            
            // 1. Recoger y sanitizar datos del formulario
            $frase = $_POST['frase'] ?? '';
            $palabraFaltante = $_POST['palabraFaltante'] ?? '';
            $pistaInicial = $_POST['pistaInicial'] ?? '';
            
            // 2. Validación básica (se puede expandir)
            if (empty($frase) || empty($palabraFaltante) || empty($pistaInicial)) {
                $this->mensaje = "Error: Faltan campos obligatorios para la frase.";
                return;
            }

            $idFrase = $this->fraseMod->crearFraseYpista(
                $frase,
                $palabraFaltante,
                $pistaInicial
            );

            if ($idFrase) {
                $this->mensaje = "Frase guardada correctamente con ID: " . $idFrase;
            } else {
                $this->mensaje = "Error al guardar la frase. Revise logs de base de datos.";
            }
        }

        public function anadirPistaAdicional() {
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

        public function eliminarFrase() {
            $idFrase = $_REQUEST['idFrase'] ?? null; // Puede venir por GET o POST

            if (empty($idFrase)) {
                $this->mensaje = "Error: No se proporcionó ID para eliminar.";
                return;
            }
            
            // Llama al método del modelo para eliminar (CASCADE se encarga de las pistas)
            $exito = $this->fraseMod->eliminarFrase($idFrase);
            
            if ($exito) {
                $this->mensaje = "Frase ID: {$idFrase} eliminada correctamente.";
            } else {
                $this->mensaje = "Error al eliminar la frase.";
            }
        }
    }
?>