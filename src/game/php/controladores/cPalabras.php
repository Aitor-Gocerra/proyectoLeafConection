<?php
require_once __DIR__ . '/../modelos/mPalabra.php';

class CPalabras
{

    private $palabraMod;
    public $mensaje;
    public $palabra;
    public $correcta;
    public $pista;
    public $vista;

    public function __construct()
    {

        $this->palabraMod = new Palabra();
        $this->vista = '';
    }

    public function cargaDatosJuego()
    {

        $this->vista = 'palabraDia';

        $this->palabra = $this->palabraMod->mostrarPalabra();

        // Verificamos si realmente se encontró una palabra para hoy (si no es false)
        if ($this->palabra) {

            // Extraemos el ID del array que nos devolvió el modelo
            $idPalabra = $this->palabra['idPalabra'];

            // Ahora sí podemos pedir la pista usando ese ID
            $this->pista = $this->palabraMod->mostrarPista($idPalabra);
            $this->correcta = $this->palabraMod->palabraCorrecta($idPalabra);

        } else {
            // Si no hay palabra programada para hoy, dejamos todo vacío o ponemos un mensaje
            $this->palabra = null;
            $this->pista = null;
            $this->mensaje = "No hay palabra programada para la fecha de hoy.";
        }

        return [
            'palabra' => $this->palabra,
            'pista' => $this->pista,
            'mensaje' => $this->mensaje,
            'correcta' => $this->correcta
        ];

    }

    public function obtenerPalabraJSON()
    {
        // No cargo ninguna vista
        $this->vista = '';
        header('Content-Type: application/json'); //Esto es necesario para que sepa que tipo de informacion va a recibir

        $palabra = $this->palabraMod->mostrarPalabra();

        if ($palabra) {
            $idPalabra = $palabra['idPalabra'];
            $correcta = $this->palabraMod->palabraCorrecta($idPalabra);

            echo json_encode([ //Paso los datos que recibo
                'success' => true,
                'palabra' => $correcta['palabra'],
                'idPalabra' => $idPalabra
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'No hay palabra programada para hoy'
            ]);
        }
    }

    public function guardarPartida()
    {
        $this->vista = '';
        header('Content-Type: application/json');

        $idUsuario = $_SESSION['idUsuario'] ?? null;

        if (!$idUsuario) {
            echo json_encode([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ]);
            return;
        }

        // Verificar si ya jugó hoy
        if ($this->palabraMod->haJugadoHoy($idUsuario)) {
            echo json_encode([
                'success' => false,
                'error' => 'Ya has jugado la palabra del día hoy'
            ]);
            return;
        }

        // Obtener datos del POST
        $idPalabra = $_POST['idPalabra'] ?? null;
        $temporizador = $_POST['tiempo'] ?? 0;
        $puntuacion = $_POST['puntuacion'] ?? 0;
        $intentos = $_POST['intentos'] ?? 1;

        if (!$idPalabra) {
            echo json_encode([
                'success' => false,
                'error' => 'Datos incompletos'
            ]);
            return;
        }

        // Guardar la partida en la base de datos
        $resultado = $this->palabraMod->guardarPartida($idPalabra, $temporizador, $puntuacion, $intentos, $idUsuario);

        if ($resultado['success']) {
            echo json_encode([
                'success' => true,
                'mensaje' => 'Partida guardada correctamente',
                'puntuacion' => $puntuacion
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Error al guardar la partida: ' . $resultado['error']
            ]);
        }
    }
}
?>