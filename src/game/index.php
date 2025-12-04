<?php
    require_once 'php/config/config.php';

    if(!isset($_GET['c'])) $_GET['c'] = DEF_CONTROLLER; // Controlador por defecto
    
    if(!isset($_GET['m'])) $_GET['m'] = DEF_METHOD; // Método por defecto

    $rutaControlador = RUTA_CONTROLADORES . $_GET['c'] . '.php';
    require_once $rutaControlador;

    $controlador = 'C' . $_GET['c'];
    $objControlador = new $controlador();

    $datos = []; // Guardar los datos que se obtienen del método

 if (method_exists($objControlador, $_GET['m'])){
        
        // 🔑 CAMBIO CLAVE AQUÍ: Detectar el tipo de petición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Llamar al método y pasar $_POST como argumento (para registrar, inicio, aceptarSolicitud, etc.)
            $datos = $objControlador->{$_GET['m']}($_POST);
        } else {
            // Llamar al método sin argumentos (para cargar la vista inicial, mostrarRegistrar, etc.)
            $datos = $objControlador->{$_GET['m']}();
        }
    }
    
    // 5. Renderizar la Vista
    if ($objControlador->vista != '') {
        if (is_array($datos)) extract($datos); 
        require_once RUTA_VISTAS . $objControlador->vista . '.php';
    }
?>