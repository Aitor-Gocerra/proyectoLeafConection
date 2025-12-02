<?php 

    require_once '../modelos/Frase.php';

    class CGestionarFrases {
        
        public $objFrase;
        public $vista;

        public function __construct(){
            $this->objFrase = new Frase();
            $this->vista = '';
        }

        public function principal(){
            $this->vista = 'gestionarFrases';
        }

        public function añadir(){
            $frase = $_POST['frase'];
            $palabraFaltante = $_POST['palabra'];
            $fechaProgramada = $_POST['fecha'];

            $this->objFrase->añadir($frase, $palabraFaltante, $fechaProgramada);
        }

    }

?>