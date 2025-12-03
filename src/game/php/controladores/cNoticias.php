<?php 

    require_once __DIR__ .'/../modelos/Noticia.php';

    class CNoticias {

        public $objNoticia;
        public $vista;

        public function __construct(){
            $this->objNoticia = new Noticia;
            $this->vista = '';
        }

        public function noticiaDia(){
            $noticia = $this->objNoticia->obtenerNoticiaDelDia();
            $preguntas = $this->objNoticia->obtenerPreguntas($noticia['idNoticia']);
            $opciones = $this->objNoticia->obtenerOpciones($noticia['idNoticia']);

            $this->vista = 'noticiaDia';
            return ['noticia' => $noticia, 'preguntas' => $preguntas, 'opciones' => $opciones];
        }
    }