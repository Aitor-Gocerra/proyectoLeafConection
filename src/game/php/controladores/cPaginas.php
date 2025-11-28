<?php 

    class CPaginas {

        public $vista;

        public function __construct() {
            $this->vista = '';
        }

        public function inicio() {
            $this->vista = 'inicio';
        }

        public function palabraDia() {
            $this->vista = 'palabraDia';
        }

        public function fraseDia() {
            $this->vista = 'fraseDia';
        }

        public function noticiaDia() {
            $this->vista = 'noticiaDia';
        }

        public function consejoDia() {
            $this->vista = 'consejoDia';
        }
    }


?>