<?php 

    require_once '../modelos/Consejo.php';

    class CGestionarConsejos {
        
        public $objConsejo;
        public $vista;

        public function __construct(){
            $this->objConsejo = new Consejo();
            $this->vista = '';
        }

        public function principal(){
            $tematicas = $this->objConsejo->listarTematicas();
            $this->vista = 'gestionarConsDia';
            return ['tematicas' => $tematicas];
        }

        public function añadir(){

        }

    }

?>