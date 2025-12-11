<?php
require_once __DIR__ . '/mConexion.php';

class Usuarios extends Conexion
{
    public function anadirUsuario($nombre, $correo, $password)
    {
        $sql = "
            INSERT INTO Administrador (nombre, correo, password) 
            VALUES (:nombre, :correo, :password)
            ";

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
        $sql = "
            SELECT * 
            FROM Usuario 
            ORDER BY idUsuario DESC
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modificarEstadoUsuario($idUsuario, $estado)
    {
        $sql = "
            UPDATE Usuario 
            SET estado = :estado 
            WHERE idUsuario = :idUsuario
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':estado', (int) $estado, PDO::PARAM_INT);
        $stmt->bindValue(':idUsuario', (int) $idUsuario, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function buscarUsuarios($buscar)
    {
        $sql = "
            SELECT * 
            FROM Usuario 
            WHERE nombre LIKE :nombre 
            OR correo LIKE :correo 
            ORDER BY idUsuario DESC
        ";
        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $buscar . '%';
        $stmt->bindParam(':nombre', $termino);
        $stmt->bindParam(':correo', $termino);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


