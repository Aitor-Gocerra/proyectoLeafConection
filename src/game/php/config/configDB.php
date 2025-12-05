<?php
    // 1. DEFINICIÓN DE CONSTANTES CON TUS DATOS
    // Nota: Uso comillas simples '' en el password para evitar conflictos con caracteres especiales.
    define("servidor", "21.daw.esvirgua.com");
    define("usuario", "daw_userbd21");
    define("password", '21NTiJq]K)7]SQB=');
    define("nombreDB", "daw_21_BD1");

    // 2. DEFINICIÓN DE LA CLASE DE CONEXIÓN
    class Db {
        public $conexion;
        
        public function __construct() {
            try {
                // Usamos las constantes definidas
                $this->conexion = new PDO(
                    "mysql:host=" . servidor . ";dbname=" . nombreDB . ";charset=utf8", 
                    usuario, 
                    password
                );
                
                // Configuración de errores y emulación de sentencias preparadas
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                // Si falla la conexión, mostramos el error (útil para depurar ahora)
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
    }
?>