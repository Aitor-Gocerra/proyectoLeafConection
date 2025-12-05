<?php 

    require_once __DIR__ .'/../modelos/mNoticia.php';

    class CNoticias {
        public $objNoticia;
        public $vista;
        public $mensaje;
        public $respuestasCorrectas = [];
        public $respuestasUsuario = [];

        public function __construct(){
            $this->objNoticia = new Noticia();
            $this->vista = '';
        }

        public function noticiaDia(){
            $noticia = $this->objNoticia->obtenerNoticiaDelDia();
            $preguntas = $this->objNoticia->obtenerPreguntas($noticia['idNoticia']);
            $opciones = $this->objNoticia->obtenerOpciones($noticia['idNoticia']);

            $this->vista = 'noticiaDia';
            $idUsuario = $_SESSION['idUsuario'] ?? 2; // A modo de ejemplo

            $datos = ['noticia' => $noticia, 'preguntas' => $preguntas, 'opciones'  => $opciones];

            // Información extra después de guardar partida
            if (!empty($this->mensaje)) {
                $datos['mensaje'] = $this->mensaje;
                $datos['respuestasCorrectas'] = $this->respuestasCorrectas ?? [];
                $datos['respuestasUsuario']   = $this->respuestasUsuario   ?? [];
            }

            return $datos;
        }

        public function guardarPartidaNoticiaDia(){
            $idUsuario = $_SESSION['idUsuario'] ?? 2; // A modo de ejemplo

            if ($this->objNoticia->haJugadoHoy($idUsuario)){
                $this->mensaje = 'Ya has jugado este juego';
                return $this->noticiaDia();
            }

            $idNoticia = $_GET['idNoticia']; 
            $temporizador = $_POST['tiempo']; // A modo de ejemplo también


            $this->respuestasCorrectas = [];
            $filasRespuestas = $this->objNoticia->obtenerRespuestas($idNoticia);
            if (is_array($filasRespuestas)) {
                foreach ($filasRespuestas as $indice => $fila) {
                    $nPregunta = $indice + 1;
                    $this->respuestasCorrectas[$nPregunta] = (int)$fila['nOpcion'];
                }
            }

            $this->respuestasUsuario = [];
            foreach ($this->respuestasCorrectas as $nPregunta => $_POST[$nPregunta]) {
                $this->respuestasUsuario[$nPregunta] = (int)$_POST[$nPregunta];
            }

            $puntuacion = 0;
            $intentos = 1; // A modo de ejemplo

            foreach ($this->respuestasCorrectas as $nPregunta => $nOpcionCorrecta) {
                if ($this->respuestasUsuario[$nPregunta] == $nOpcionCorrecta) {
                    $puntuacion += 3; // Sumar puntos
                }
            }

            $resultado = $this->objNoticia->guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario);
            if ($resultado){
                $this->mensaje = 'Has obtenido ' . $puntuacion . ' puntos';
            } else {
                $this->mensaje = 'Error al guardar la partida';
            }

            return $this->noticiaDia();
        }

        
    }
?>