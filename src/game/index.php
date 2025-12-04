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
        
        // 🔑 CAMBIO CLAVE AQUÍ: Lógica de despacho robusta
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Caso 1: Es POST, enviamos los datos. (Ej: inicio($_POST), registrar($_POST))
            $datos = $objControlador->{$_GET['m']}($_POST);
            
        } else {
            // Caso 2: Es GET, solo llamamos si el método no espera argumentos.
            
            // Usamos ReflectionClass para verificar la cantidad de argumentos esperados.
            $reflectionMethod = new ReflectionMethod($controlador, $_GET['m']);
            $numRequiredArgs = $reflectionMethod->getNumberOfRequiredParameters();

            if ($numRequiredArgs > 0) {
                // Si el método requiere argumentos (ej: inicio($datos)), pero la petición es GET,
                // redirigimos al método por defecto o a la vista de login para evitar el Fatal Error.
                header("Location: index.php?c=" . $_GET['c'] . "&m=" . DEF_METHOD);
                exit();
            }
            
            // Si el método no requiere argumentos (Ej: mostrarLogin(), predeterminada()), lo llamamos.
            $datos = $objControlador->{$_GET['m']}();
        }
    }
    
    // 5. Renderizar la Vista
    if ($objControlador->vista != '') {
        if (is_array($datos)) extract($datos); 
        require_once RUTA_VISTAS . $objControlador->vista . '.php';
    }
?>