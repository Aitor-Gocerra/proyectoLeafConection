<?php

require_once __DIR__ . '/../modelos/mNoticia.php';

class CNoticias
{
    public $objNoticia;
    public $vista;
    public $mensaje;
    public $respuestasCorrectas = [];
    public $respuestasUsuario = [];

    public function __construct()
    {
        $this->objNoticia = new Noticia();
        $this->vista = '';
    }

    public function noticiaDia()
    {
        $noticia = $this->objNoticia->obtenerNoticiaDelDia();
        $preguntas = $this->objNoticia->obtenerPreguntas($noticia['idNoticia']);
        $opciones = $this->objNoticia->obtenerOpciones($noticia['idNoticia']);

        $this->vista = 'noticiaDia';
        $idUsuario = $_SESSION['idUsuario'] ?? 2; // A modo de ejemplo

        $datos = ['noticia' => $noticia, 'preguntas' => $preguntas, 'opciones' => $opciones];

        // Información extra después de guardar partida
        if (!empty($this->mensaje)) {
            $datos['mensaje'] = $this->mensaje;
            $datos['respuestasCorrectas'] = $this->respuestasCorrectas ?? [];
            $datos['respuestasUsuario'] = $this->respuestasUsuario ?? [];
        }

        return $datos;
    }

    public function obtenerDatosJSON()
    {
        $this->vista = '';
        header('Content-Type: application/json');

        $noticia = $this->objNoticia->obtenerNoticiaDelDia();

        if (!$noticia) {
            echo json_encode(['success' => false, 'error' => 'No hay noticia hoy']);
            return;
        }

        $filasRespuestas = $this->objNoticia->obtenerRespuestas($noticia['idNoticia']);
        $respuestasCorrectas = [];

        if (is_array($filasRespuestas)) {
            foreach ($filasRespuestas as $indice => $fila) {
                // Asumiendo que las respuestas vienen en orden
                $respuestasMapeadas[$indice + 1] = (int) $fila['nOpcion'];
            }
        }

        echo json_encode([
            'success' => true,
            'idNoticia' => $noticia['idNoticia'],
            'respuestasCorrectas' => $respuestasMapeadas
        ]);
    }

    public function guardarPartida()
    {
        $this->vista = '';
        header('Content-Type: application/json');

        $idUsuario = $_SESSION['idUsuario'] ?? null;

        if (!$idUsuario) {
            echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
            return;
        }

        // Verificar si ya jugó hoy
        if ($this->objNoticia->haJugadoHoy($idUsuario)) {
            echo json_encode(['success' => false, 'error' => 'Ya has jugado este juego hoy']);
            return;
        }

        $idNoticia = $_POST['idNoticia'] ?? null;
        $temporizador = $_POST['tiempo'] ?? 0;
        $puntuacion = $_POST['puntuacion'] ?? 0;
        $intentos = 1;

        if (!$idNoticia) {
            echo json_encode(['success' => false, 'error' => 'Faltan datos']);
            return;
        }

        $resultado = $this->objNoticia->guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario);

        if ($resultado['success']) {
            echo json_encode([
                'success' => true,
                'mensaje' => 'Partida guardada',
                'puntuacion' => $puntuacion
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Error al guardar: ' . $resultado['error']
            ]);
        }
    }


}
?>