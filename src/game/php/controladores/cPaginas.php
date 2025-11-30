<?php

    class CPaginas{

        public $vista;

        public function __construct(){
            $this->vista = '';
        }

        public function login(){
            $this->vista = 'login';
        }

        public function registro(){
            $this->vista = 'registro';
        }   
        public function inicio(){
            $this->vista = 'inicio';
        }

        public function palabraDia(){
            $this->vista = 'palabraDia';
        }

        public function fraseDia(){
            $this->vista = 'fraseDia';
        }

        public function noticiaDia(){
            $this->vista = 'noticiaDia';
        }

        public function consejoDia(){
            $this->vista = 'consejoDia';
        }

        public function estadisticas(){
            $this->vista = 'estadisticas';
        }

        public function amigos(){
            $this->vista = 'gestionAmigos';
        }
    }


?>