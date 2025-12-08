<?php
    DEFINE ("servidor", "localhost"); 
    DEFINE ("usuario", "root");
    DEFINE ("password", "");
    DEFINE ("nombreDB", "leafconnect");
    class Db {
        public $conexion;
        
        public function __construct() {
            try {
                $this->conexion = new PDO(
                    "mysql:host=" . servidor . ";dbname=" . nombreDB . ";charset=utf8", 
                    usuario, 
                    password
                );
                
                // Configuración de errores y emulación de sentencias preparadas
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
    }
?>