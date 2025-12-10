<?php
require_once __DIR__ . '/mConexion.php';

class Usuarios extends Conexion
{
    public function anadirUsuario($nombre, $correo, $password)
    {
        $sql = "
            INSERT INTO Usuario (nombre, correo, pw, estado) 
            VALUES (:nombre, :correo, :password, 1)
            ";
        // Note: Table name in DB script is 'Usuario', not 'Usuarios'.
        // Column is 'pw', not 'password'.
        // Correcting this now based on schema.

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return $this->conexion->lastInsertId();
        }
        return false;
    }

    public function listarUsuarios()
    {
        $sql = "SELECT * FROM Usuario ORDER BY idUsuario DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modificarEstadoUsuario($idUsuario, $estado)
    {
        $sql = "UPDATE Usuario SET estado = :estado WHERE idUsuario = :idUsuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarUsuario($idUsuario)
    {
        $sql = "DELETE FROM Usuario WHERE idUsuario = :idUsuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarUsuarios($buscar)
    {
        // Table 'Usuario'
        $sql = "SELECT * FROM Usuario WHERE nombre LIKE :buscar OR correo LIKE :buscar ORDER BY idUsuario DESC";
        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $buscar . '%';
        $stmt->bindParam(':buscar', $termino);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>