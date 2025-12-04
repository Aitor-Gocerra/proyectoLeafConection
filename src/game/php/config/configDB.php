<?php
    // 1. DEFINICIÓN DE CONSTANTES (Tus datos originales)
    DEFINE ("servidor", "localhost");
    DEFINE ("usuario", "root");
    DEFINE ("password", "");
    DEFINE ("nombreDB", "prueba");

    // 2. DEFINICIÓN DE LA CLASE DE CONEXIÓN
    // Esta clase usa las constantes de arriba para crear la conexión PDO.
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
                // Establecemos el modo de error para que PDO lance excepciones
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Si falla la conexión, mostramos un error fatal.
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
    }
?>