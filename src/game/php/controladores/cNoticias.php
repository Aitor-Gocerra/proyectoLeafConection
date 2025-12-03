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

        public function guardarPartidaNoticiaDia(){ // FALTAN LAS VALIDACIONES DE RADIOBUTTONS, HACERLAS EN JS
            $idUsuario = $_SESSION['idUsuario'] ?? 2; // ELIMINAR
            $idNoticia = $_GET['idNoticia']; 
            $temporizador = $_POST['tiempo'];
            $respuestas = $this->objNoticia->obtenerRespuestas($idNoticia);

            $puntuacion = 0;
            $intentos = 1;

            // Compruebo que las respuestas coincidan con las de la tabla RespuestaCorrecta.
            foreach ($respuestas as $respuesta) {
                $i = $respuesta['nPregunta'];
                if ((int) $_POST[$i] === (int) $respuesta['nOpcion']) {
                    $puntuacion += 3; // Cada respuesta correcta suma 3 puntos.
                }
            }

            $mensaje = '';
            if ($this->objNoticia->guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario)){
                $mensaje = 'Has obtenido ' . $puntuacion . ' puntos';
            } else {
                $mensaje = 'Error al guardar la partida';
            }

            $this->vista = 'inicio';
            return ['mensaje' => $mensaje];
        }
    }

?>