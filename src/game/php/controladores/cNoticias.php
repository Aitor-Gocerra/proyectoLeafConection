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
            $idUsuario = $_SESSION['idUsuario'] ?? 2; 
            $idNoticia = $_GET['idNoticia']; 
            $temporizador = $_POST['tiempo'];

            $this->respuestasCorrectas = [];
            $filasRespuestas = $this->objNoticia->obtenerRespuestas($idNoticia);
            if ($filasRespuestas && is_array($filasRespuestas)) {
                foreach ($filasRespuestas as $indice => $fila) {
                    $nPregunta = $indice + 1;
                    $this->respuestasCorrectas[$nPregunta] = (int)$fila['nOpcion'];
                }
            }

            $this->respuestasUsuario = [];
            foreach ($this->respuestasCorrectas as $nPregunta => $_) {
                if (isset($_POST[$nPregunta])) {
                    $this->respuestasUsuario[$nPregunta] = (int)$_POST[$nPregunta];
                }
            }

            $puntuacion = 0;
            $intentos = 1;

            foreach ($this->respuestasCorrectas as $nPregunta => $nOpcionCorrecta) {
                if (isset($this->respuestasUsuario[$nPregunta]) && $this->respuestasUsuario[$nPregunta] === $nOpcionCorrecta) {
                    $puntuacion += 3;
                }
            }

            if ($this->objNoticia->guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario)){
                $this->mensaje = 'Has obtenido ' . $puntuacion . ' puntos';
            } else {
                $this->mensaje = 'Error al guardar la partida';
            }

            return $this->noticiaDia();
        }
    }
?>