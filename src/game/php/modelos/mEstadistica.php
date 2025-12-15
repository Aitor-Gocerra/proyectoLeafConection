<?php
require_once __DIR__ . '/mConexion.php';

class mEstadistica extends Conexion{

    public function partidasJugadas($idUsuario){
        $sql = 'SELECT COUNT(*) AS total FROM Partida WHERE idUsuario = :idUsuario;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario]);
            $resultado = $sth->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function puntuacionTotal($idUsuario){
        $sql = 'SELECT SUM(puntuacion) AS total FROM Partida WHERE idUsuario = :idUsuario;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario]);
            $resultado = $sth->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function mayorPuntuacion($idUsuario){
        $sql = 'SELECT MAX(puntuacion) AS total FROM Partida WHERE idUsuario = :idUsuario;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario]);
            $resultado = $sth->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function tiempoMedioPorPartida($idUsuario){
        $sql = 'SELECT AVG(temporizador) AS total FROM Partida WHERE idUsuario = :idUsuario;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario]);
            $resultado = $sth->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }
    
    public function fechasJugadas($idUsuario){
        $sql = 'SELECT DISTINCT date(fecha) AS fecha FROM Partida WHERE idUsuario = :idUsuario ORDER BY DATE(fecha) DESC;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario]);
            $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function obtenerPuntajeUltimaSemana($idUsuario, $fechaInicio, $fechaFin){
        $sql = 'SELECT SUM(puntuacion) AS puntaje, DATE(fecha) AS fecha FROM Partida
                WHERE 
                    idUsuario = :idUsuario AND 
                    fecha BETWEEN :fechaInicio AND :fechaFin
                GROUP BY (DATE(fecha))
                ORDER BY DATE(fecha) ASC;';

        try{
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin]);
            $resultado = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch(PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }
}