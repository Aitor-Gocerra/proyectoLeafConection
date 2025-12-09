<?php 
    require_once __DIR__ . '/../modelos/mEstadistica.php';

    class cEstadisticas {
        public $objEstadistica;
        public $vista;
        public $mensaje;

        public function __construct(){
            $this->objEstadistica = new mEstadistica();
            $this->vista = '';
        }

        public function obtenerEstadisticasJSON(){
            $this->vista = '';
            header('Content-Type: application/json');
            $idUsuario = $_SESSION['idUsuario'];

            if (!$idUsuario) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Usuario no definido'
                ]);
                return;
            }

            try { // Para capturar cualquier errror que venga del modelo
                $partidas = $this->objEstadistica->partidasJugadas($idUsuario);
                $puntuacionTotal = $this->objEstadistica->puntuacionTotal($idUsuario);
                $mayorPuntuacion = $this->objEstadistica->mayorPuntuacion($idUsuario);
                $tiempoMedio = $this->objEstadistica->tiempoMedioPorPartida($idUsuario);
                $racha = $this->obtenerRacha($idUsuario);

                echo json_encode([
                    'success' => true,
                    'partidasJugadas' => $partidas,
                    'puntuacionTotal' => $puntuacionTotal,
                    'mayorPuntuacion' => $mayorPuntuacion,
                    'tiempoMedioPorPartida' => $tiempoMedio,
                    'racha' => $racha
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }

        private function obtenerRacha($idUsuario){
            $fechasJugadas = $this->objEstadistica->fechasJugadas($idUsuario);
            if (empty($fechasJugadas)){
                return 0;
            } 

            $racha = 0;
            $hoy = date('Y-m-d');

            foreach ($fechasJugadas as $fecha) {
                if ($fecha == $hoy) {
                    $racha++;
                    $hoy = date('Y-m-d', strtotime($hoy . ' -1 day'));
                } else {
                    return $racha;
                }
            }
        }

    }
?>