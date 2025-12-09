<?php
require_once 'php/config/config.php';

session_start();

if (!isset($_GET['c']))
    $_GET['c'] = DEF_CONTROLLER; // Controlador por defecto

if (!isset($_GET['m']))
    $_GET['m'] = DEF_METHOD; // Método por defecto

$rutaControlador = RUTA_CONTROLADORES . $_GET['c'] . '.php';
require_once $rutaControlador;

$controlador = 'C' . $_GET['c'];
$objControlador = new $controlador();

$datos = []; // Guardar los datos que se obtienen del método

if(method_exists($objControlador, $_GET['m'])){
    $datos = $objControlador->{$_GET['m']}();
}

if(isset($datos['idUsuario'])){
    $_SESSION['idUsuario']= $datos['idUsuario'];
    $_SESSION['nombreUsuario']= $datos['nombreUsuario'];
}

if ($objControlador->vista != '') {
    if (is_array($datos))
        extract($datos);
    require_once RUTA_VISTAS . $objControlador->vista . '.php';
}
?>