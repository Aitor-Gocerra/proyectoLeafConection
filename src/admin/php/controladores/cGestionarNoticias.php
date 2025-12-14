<?php 
    // Usamos el modelo de administración de noticias (mNoticias.php), no el de juego
    require_once __DIR__ .'/../modelos/mNoticias.php';

    class CGestionarNoticias{
        public $objNoticia;
        public $vista;
        public $mensaje;
        public $listaNoticias;
        public $idNoticia;

        public function __construct(){
            $this->objNoticia = new Noticia();
            $this->vista = '';
            $this->idNoticia = $_GET['idNoticia'] ?? NULL;
        }

        public function gestionarNoticias(){
            $this->vista = 'gestionarNoticias';
            $this->listaNoticias = $this->objNoticia->listarNoticias();
            $fechasUsadas = $this->objNoticia->obtenerFechasNoticias();
            return ['noticias' => $this->listaNoticias, 'mensaje' => $this->mensaje, 'fechasUsadas' => $fechasUsadas];
        }

        public function añadirNoticia(){
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $url = $_POST['url'];
            $fecha = $_POST['fecha'] ?? NULL;
            $preguntas = $_POST['preguntas'];
            $opciones = $_POST['opciones'];
            $respuestas = $_POST['respuestas_correctas'];

            $arrOpciones = [];
            foreach ($opciones as $i => $opcion) {
                $elementos = explode('/', $opcion);
            
                foreach ($elementos as $j => $elemento) {
                    $texto = trim($elemento);
                    $arrOpciones[$i][$j] = $texto;
                }
            }

            $resultado = $this->objNoticia->añadir($titulo, $noticia, $fecha, $url, $preguntas, $arrOpciones, $respuestas);

            if ($resultado) {
                $this->mensaje = "La noticia ha sido agregada.";
                return $this->gestionarNoticias();
            } else {
                $this->mensaje = "Error al añadir la noticia.";
                return $this->gestionarNoticias();
            }
        }

        public function buscarNoticias(){
            $buscar = $_GET['buscar'] ?? '';
            $this->vista = 'gestionarNoticias';

            // Buscar noticias
            $resultados = $this->objNoticia->buscarNoticia($buscar);
    
            $noticias = $this->objNoticia->listarNoticias();
    
            return [
                'resultadosBusqueda' => $resultados, // Listado de noticias que coincidan con $buscar
                'noticias' => $noticias, // Volver a cargar las últimas 10 noticias
            ];
        }

        public function eliminar(){
            header('Content-Type: application/json');
            $exito = $this->objNoticia->eliminarNoticia($this->idNoticia);
            if ($exito) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'No se pudo eliminar']);
            }
        }
        
        public function modificarJSON() {
            $idNoticia = $_GET['idNoticia'] ?? null;
            if (!$idNoticia) {
                echo json_encode(['mensaje' => 'No se indicó idNoticia']);
                return;
            }

            $noticia = $this->objNoticia->obtenerNoticia($idNoticia);
            $preguntas = $this->objNoticia->obtenerPreguntas($idNoticia);
            $opciones = $this->objNoticia->obtenerOpciones($idNoticia);
            $opcionesCorrectas = $this->objNoticia->obtenerRespuestas($idNoticia);

            $opcionesPorPregunta = [];
            foreach ($opciones as $op) $opcionesPorPregunta[$op['nPregunta']][] = $op['opcion'];

            $opcionesImplode = [];
            foreach ($preguntas as $i => $p) {
                $n = $i + 1;
                $opcionesImplode[$i] = isset($opcionesPorPregunta[$n]) ? implode('/', $opcionesPorPregunta[$n]) : '';
            }

            $respuestas = [];
            foreach ($opcionesCorrectas as $r) {
                if (isset($r['nPregunta']) && isset($r['nOpcion'])) {
                    $respuestas[$r['nPregunta'] - 1] = $r['nOpcion'];
                }
            }
            for ($i = 0; $i < count($preguntas); $i++) {
                if (!isset($respuestas[$i])) $respuestas[$i] = '';
            }

            header('Content-Type: application/json');
            echo json_encode([
                'noticia' => $noticia,
                'preguntas' => $preguntas,
                'opciones_implode' => $opcionesImplode,
                'respuestas' => $respuestas
            ]);
        }


        public function guardarModificacion(){
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $fecha = $_POST['fecha'] ?? NULL;
            $url = $_POST['url'];
            $preguntas = $_POST['preguntas'];
            $opciones = $_POST['opciones'];
            $respuestas = $_POST['respuestas_correctas'];

            $arrOpciones = [];
            foreach ($opciones as $i => $opcion) {
                $elementos = explode('/', $opcion); // separar por '/'
            
                foreach ($elementos as $j => $elemento) {
                    $texto = trim($elemento);
                    $arrOpciones[$i][$j] = $texto;
                }
            }

            $resultado = $this->objNoticia->modificar($this->idNoticia, $titulo, $noticia, $fecha, 
            $url, $preguntas, $arrOpciones, $respuestas);

            if ($resultado) {
                header("Location: ./index.php?c=GestionarNoticias&m=gestionarNoticias");
                exit;
            } else {
                $this->mensaje = "Error en la modificación.";
                return $this->gestionarNoticias();
            }
        }

        public function fechasOcupadasJSON() {
            $fechas = $this->objNoticia->obtenerFechasNoticias();
            echo json_encode(['fechas' => $fechas]);
        }

        public function fechasOcupadasModificarJSON() {
            $idNoticia = $_GET['idNoticia'] ?? null;
            if (!$idNoticia) {
                echo json_encode(['error' => 'No se indicó idNoticia']);
                return;
            }
            $fechas = $this->objNoticia->obtenerFechasNoticiasExcepto($idNoticia);
            echo json_encode(['fechas' => $fechas]);
        }
    }
?>