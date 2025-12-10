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
                $datosPuntuacion = $this->obtenerPuntajeUltimaSemana($idUsuario);

                echo json_encode([
                    'success' => true,
                    'partidasJugadas' => $partidas,
                    'puntuacionTotal' => $puntuacionTotal,
                    'mayorPuntuacion' => $mayorPuntuacion,
                    'tiempoMedioPorPartida' => $tiempoMedio,
                    'racha' => $racha,
                    'datosPuntuacion' => $datosPuntuacion
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }

        public function obtenerRacha($idUsuario){
            $fechasJugadas = $this->objEstadistica->fechasJugadas($idUsuario);
            if (empty($fechasJugadas)){
                return 0;
            } 

            $racha = 0;
            $hoy = date('Y-m-d');

            foreach ($fechasJugadas as $fecha) {
                if ($fecha['fecha'] == $hoy) {
                    $racha++;
                    $ayer = strtotime('-1 day', strtotime($hoy));
                    $ayer = date('Y-m-d', $ayer);
                    $hoy = $ayer;
                }
            }

            return $racha ?? 0;
        }

        public function obtenerPuntajeUltimaSemana($idUsuario){
            $fechaInicio = date('Y-m-d', strtotime('-6 day')); // hace 6 días (7 días incluyendo hoy)
            $fechaFin = date('Y-m-d', strtotime('+1 day')); // como usabas antes (no se usa aquí, lo necesita el modelo)

            $datosPuntuacion = $this->objEstadistica->obtenerPuntajeUltimaSemana($idUsuario, $fechaInicio, $fechaFin);

            $datos = [];
            $actual = strtotime($fechaInicio);

            for ($i = 0; $i < 7; $i++) {
                $f = date('Y-m-d', $actual);
                $sw = false;

                foreach ($datosPuntuacion as $fila) {
                    if ($fila['fecha'] == $f) {
                        $datos[] = [
                            'puntaje' => $fila['puntaje'],
                            'fecha'   => $fila['fecha']
                        ];
                        $sw = true;
                        break;
                    }
                }

                if (!$sw) {
                    $datos[] = [
                        'puntaje' => "0",
                        'fecha'   => $f
                    ];
                }

                $actual = strtotime('+1 day', $actual);
            }

            return $datos;
        }


        // Sector pruebas ELIMINAR DESPUES
        public function prueba(){

            $idUsuario = $_SESSION['idUsuario'];
            $fechaInicio = date('Y-m-d', strtotime('-6 day', strtotime(date('Y-m-d'))));
            $fechaFin = date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))));

            $datosPuntuacion = $this->objEstadistica->obtenerPuntajeUltimaSemana($idUsuario, $fechaInicio, $fechaFin);
            
            var_dump($datosPuntuacion);
        }
    }
?>