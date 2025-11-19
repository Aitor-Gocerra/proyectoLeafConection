<?php

class AutenticacionMiddleware {

    public static function verificar() {
        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            http_response_code(401);
            echo "Debes iniciar sesión";
            exit();
        }
    }
}
