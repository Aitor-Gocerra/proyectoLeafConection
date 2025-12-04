<?php 
    // Usamos el modelo de administración de noticias (mNoticias.php), no el de juego
    require_once __DIR__ .'/../modelos/mNoticias.php';

    class CGestionarNoticias{
        public $objNoticia;
        public $vista;
        public $mensaje;
        public $listaNoticias;

        public function __construct(){
            $this->objNoticia = new Noticia();
            $this->vista = '';
        }

        public function gestionarNoticias(){
            $this->vista = 'gestionarNoticias';
            $this->listaNoticias = $this->objNoticia->listarNoticias();
            return ['noticias' => $this->listaNoticias, 'mensaje' => $this->mensaje];
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
                if (trim($opcion) === '') continue; // evitar valores vacíos
            
                $elementos = explode('/', $opcion); // separar por '/'
            
                foreach ($elementos as $j => $elemento) {
                    $texto = trim($elemento);
                    $arrOpciones[$i][$j] = $texto;
                }
            }

            if ($this->objNoticia->añadir($titulo, $noticia, $fecha, 
            $url, $preguntas, $arrOpciones, $respuestas)){
                $this->mensaje = "La noticia ha sido agregada.";
                $this->gestionarNoticias();
            }
        }

        public function buscarNoticias(){
            $buscar = $_GET['buscar'] ?? '';
            $this->vista = 'gestionarNoticias';
            if (empty($buscar)) {
                $this->mensaje = "Por favor, introduce un término de búsqueda.";
                return ['mensaje' => $this->mensaje];
            }
    
            // Buscar noticias
            $resultados = $this->objNoticia->buscarNoticia($buscar);
    
            // También cargar las 10 últimas noticias para que no desaparezcan
            $noticias = $this->objNoticia->listarNoticias();
    
            return [
                'resultadosBusqueda' => $resultados,
                'noticias' => $noticias,
                'mensaje' => $this->mensaje
            ];
        }

        public function modificar(){
            $idNoticia = $_GET['idNoticia'];

            $noticia = $this->objNoticia->obtenerNoticia($idNoticia);

            $this->vista = 'gestionarNoticias';
            return ['noticia' => $noticia];
        }

    }