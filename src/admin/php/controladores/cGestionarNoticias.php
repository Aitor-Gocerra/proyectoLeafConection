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
                $elementos = explode('/', $opcion); // separar por '/'
            
                foreach ($elementos as $j => $elemento) {
                    $texto = trim($elemento);
                    $arrOpciones[$i][$j] = $texto;
                }
            }

            var_dump($_POST);
            echo "<br><br>";
            var_dump($arrOpciones);
            
            if ($this->objNoticia->añadir($titulo, $noticia, $fecha, 
            $url, $preguntas, $arrOpciones, $respuestas)){
                $this->mensaje = "La noticia ha sido agregada.";
                $this->gestionarNoticias();
            }
        }

        public function buscarNoticias(){
            $buscar = $_GET['buscar'] ?? '';
            $this->vista = 'gestionarNoticias';

            // Buscar noticias
            $resultados = $this->objNoticia->buscarNoticia($buscar);
    
            // También cargar las 10 últimas noticias para que no desaparezcan
            $noticias = $this->objNoticia->listarNoticias();
    
            return [
                'resultadosBusqueda' => $resultados, // Listado de noticias que coincidan con $buscar
                'noticias' => $noticias, // Volver a cargar las últimas 10 noticias
            ];
        }

        public function eliminar(){
            if ($this->objNoticia->eliminarNoticia($this->idNoticia)){
                header("Location: ./index.php?c=GestionarNoticias&m=gestionarNoticias");
            }
        }

        public function modificar(){
            $this->idNoticia = $_GET['idNoticia'] ?? null;
            if (!$this->idNoticia) {
                $this->vista = 'gestionarNoticias';
                $this->mensaje = 'No se indicó idNoticia';
                return ['mensaje' => $this->mensaje];
            }
        
            $noticia = $this->objNoticia->obtenerNoticia($this->idNoticia);
            $preguntas = $this->objNoticia->obtenerPreguntas($this->idNoticia);
            $opciones = $this->objNoticia->obtenerOpciones($this->idNoticia);
            $opcionesCorrectas = $this->objNoticia->obtenerRespuestas($this->idNoticia);
            $fechasUsadas = $this->objNoticia->obtenerFechasNoticias();


            /**
             * Agrupar opciones por pregunta. $nPregunta => [op1, op2]
             */
            $opcionesPorPregunta = [];
            foreach ($opciones as $op) {
                $nPregunta = $op['nPregunta'];
                $opcionesPorPregunta[$nPregunta][] = $op['opcion'];
            }
        
            /**
             * Crear un array con el N° de la pregunta y las opciones separadas por '/'
             */
            $opcionesImplode = [];
            foreach ($preguntas as $i => $p) {
                $n = $i + 1; // nPregunta real
                if (isset($opcionesPorPregunta[$n])) {
                    $opcionesImplode[$i] = implode('/', $opcionesPorPregunta[$n]);
                } else {
                    $opcionesImplode[$i] = '';
                }
            }
        

            $respuestas = [];
            foreach ($opcionesCorrectas as $r) {
                if (isset($r['nPregunta']) && isset($r['nOpcion'])) {
                    $respuestas[$r['nPregunta'] - 1] = $r['nOpcion'];
                }
            }
        
            // asegurarnos de que $respuestas tenga la misma longitud que $preguntas
            for ($i = 0; $i < count($preguntas); $i++) {
                if (!isset($respuestas[$i])) $respuestas[$i] = '';
            }
        
            // devolver los datos para la vista (los usaremos en JS)
            $this->vista = 'gestionarNoticias';
            return [
                'noticia' => $noticia,
                'preguntas' => $preguntas,
                'opciones_implode' => $opcionesImplode,
                'respuestas' => $respuestas,
                'fechasUsadas' => $fechasUsadas
            ];
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

            if (is_bool($resultado) && $resultado == true){
                header("Location: ./index.php?c=GestionarNoticias&m=gestionarNoticias");
            }
        }

    }