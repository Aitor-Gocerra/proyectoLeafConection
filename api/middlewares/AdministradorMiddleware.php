<?php

class AdministradorMiddleware extends AutenticacionMiddleware {

    public static function verificarAdmin() {
        parent::verificar(); // Comprobamos que está logueado

        if ($_SESSION['rol'] !== 'admin') {
            http_response_code(403);
            echo "Acceso denegado. Se requieren permisos de administrador.";
            exit();
        }
    }
}
