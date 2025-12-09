<?php 

    require_once __DIR__ .'/../modelos/mNoticia.php';

    class CNoticias {
        public $objNoticia;
        public $vista;
        public $mensaje;
        public $respuestasCorrectas = [];
        public $respuestasUsuario = [];
        public $error;

        public function __construct(){
            $this->objNoticia = new Noticia();
            $this->vista = '';
            $this->error = false;
        }

        public function noticiaDia(){
            $noticia = $this->objNoticia->obtenerNoticiaDelDia();
            $preguntas = $this->objNoticia->obtenerPreguntas($noticia['idNoticia']);
            $opciones = $this->objNoticia->obtenerOpciones($noticia['idNoticia']);

            $this->vista = 'noticiaDia';
            $idUsuario = $_SESSION['idUsuario'] ?? NULL;

            $datos = ['noticia' => $noticia, 'preguntas' => $preguntas, 'opciones'  => $opciones];

            if (!empty($this->mensaje)) {
                $datos['mensaje'] = $this->mensaje;

                // SOLO enviar respuestas si NO hubo error
                if (!$this->error && !empty($this->respuestasUsuario)) {
                    $datos['respuestasCorrectas'] = $this->respuestasCorrectas ?? [];
                    $datos['respuestasUsuario']   = $this->respuestasUsuario   ?? [];
                }
            }

            return $datos;
        }

        // Modificaciones importantes con validaciones tipo early return
        public function guardarPartidaNoticiaDia(){
            $idUsuario = $_SESSION['idUsuario'] ?? NULL;

            echo '<h1>' . $idUsuario . '</h1>';
            // 1. Por si no recibe idNoticia
            $idNoticia = $_GET['idNoticia'] ?? null;
            if ($idNoticia === null){
                $this->mensaje = 'Error: noticia no especificada.';
                return $this->noticiaDia();
            }

            // Si esl usuario existe y si el usuario ya jugó hoy, bloquear
            if ($idUsuario != NULL){
                if ($this->objNoticia->haJugadoHoy($idUsuario) ){
                    $this->mensaje = 'Ya has jugado este juego';
                    return $this->noticiaDia();
                }
            }


            // Obtener respuestas correctas desde BDD
            $this->respuestasCorrectas = [];
            $filasRespuestas = $this->objNoticia->obtenerRespuestas($idNoticia);
            foreach ($filasRespuestas as $indice => $fila) {
                $nPregunta = $indice + 1;
                $this->respuestasCorrectas[$nPregunta] = (int)$fila['nOpcion'];
            }


            // Comprobar que el POST contiene todas las respuestas esperadas
            // $_POST devuelve un array con las opciones seleccionadas
            $this->respuestasUsuario = [];
            $faltan = [];
            foreach ($this->respuestasCorrectas as $nPregunta => $nOpcionCorrecta) {
                if (!isset($_POST[$nPregunta])) {
                    $faltan[] = $nPregunta;
                } else {
                    $this->respuestasUsuario[$nPregunta] = (int)$_POST[$nPregunta];
                }
            }


            if (!empty($faltan)) {
                $this->mensaje = 'Error al enviar, necesitas completar todas las preguntas.';
                $this->error = true; // Esto evita que se envíen las respuestas cuando el cuestionario está incompleto
                return $this->noticiaDia();
            }


            // Temporizador (copiar y pegarlo de Jaime o Aitor)
            $temporizador = isset($_POST['tiempo']) ? (int)$_POST['tiempo'] : null;

            // Calcular la puntuación que por defecto es 180 está en input hidden
            $puntuacion = 0;
            $intentos = 1; // a modo de ejemplo

            foreach ($this->respuestasCorrectas as $nPregunta => $nOpcionCorrecta) {
                if (isset($this->respuestasUsuario[$nPregunta]) && $this->respuestasUsuario[$nPregunta] == $nOpcionCorrecta) {
                    $puntuacion += 3;
                }
            }

            // Si es invitado, no guardamos en BDD
            if ($idUsuario == NULL){
                $this->mensaje = 'Has obtenido ' . $puntuacion . ' puntos';
                return $this->noticiaDia();
            }

            // Guardar partida en BDD
            $resultado = $this->objNoticia->guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario);
            if ($resultado){
                if ($resultado == 0){
                    $this->mensaje = 'No has obtenido puntos. Más suerte a la próxima!';
                } else {
                    $this->mensaje = 'Has obtenido ' . $puntuacion . ' puntos!';
                }
            } else {
                $this->mensaje = 'Error al guardar la partida';
            }

            return $this->noticiaDia();
        }
    }
?>