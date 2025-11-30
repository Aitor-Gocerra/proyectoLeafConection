<?php

    class CPaginasAdmin{
        public $vista;

        public function __construct(){
            $this->vista = '';
        }

        public function gestionarPalabras(){
            $this->vista = 'gestionarPalabras';
        }

        public function gestionarFrases(){
            $this->vista = 'gestionarFrases';
        }

        public function gestionarNoticias(){
            $this->vista = 'gestionarNoticias';
        }

        public function gestionarConsejos(){
            $this->vista = 'gestionarConsejos';
        }

        public function gestionarUsuarios(){
            $this->vista = 'gestionarUsuarios';
        }
    }
 
?>