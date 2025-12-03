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
    }