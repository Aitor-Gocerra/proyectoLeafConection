<?php 
    require_once 'configdb.php';
    class Conectar {
        protected $conexion;

        public function __construct(){
            $dsn = "mysql:host=" . SERVIDOR . ";dbname=" . BDD . ";charset=utf8;";
            try{
                $this->conexion = new PDO($dsn, USUARIO, PASSWORD);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                die("Error en la conexión: " . $e->getMessage());
            }
        }

        public function __destruct(){
            $this->conexion = null;
        }
    }
?>