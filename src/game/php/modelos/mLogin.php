<?php
    require_once __DIR__ . '/../Modelos/ModConexion.php';

    class MIniciarsesion extends Conexion{

        public function inciosesion($email, $contrasenia)
        {
            // Consulta segura para evitar inyección SQL
            $sql = "SELECT email, password_hash FROM usuarios WHERE email = :email AND contrasenia = :contrasenia";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':email' => $email, ':contrasenia' => $contrasenia]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }