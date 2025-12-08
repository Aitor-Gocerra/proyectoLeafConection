<?php
require_once __DIR__ . '/../modelos/mFrase.php';

class CFrases
{

    private $fraseMod;
    public $mensaje;
    public $frase;
    public $pista;
    public $vista;

    public function __construct()
    {
        $this->fraseMod = new Frase();
        $this->vista = '';
    }

    public function cargaDatosJuego()
    {

        $this->vista = 'fraseDia';

        $this->frase = $this->fraseMod->mostrarFrase();

        // Verificamos si realmente se encontró una frase para hoy (si no es false)
        if ($this->frase) {

            // Extraemos el ID del array que nos devolvió el modelo
            $idFrase = $this->frase['idFrase'];

            // Ahora sí podemos pedir la pista usando ese ID
            $this->pista = $this->fraseMod->mostrarPista($idFrase);

        } else {
            // Si no hay frase programada para hoy, dejamos todo vacío o ponemos un mensaje
            $this->frase = null;
            $this->pista = null;
            $this->mensaje = "No hay frase programada para la fecha de hoy.";
        }
        return [
            'frase' => $this->frase,
            'pista' => $this->pista,
            'mensaje' => $this->mensaje
        ];

    }

    public function obtenerFraseJSON()
    {
        // No cargo ninguna vista
        $this->vista = '';
        header('Content-Type: application/json');

        $frase = $this->fraseMod->mostrarFrase();

        if ($frase) {
            $idFrase = $frase['idFrase'];
            $correcta = $this->fraseMod->palabraFaltante($idFrase);

            echo json_encode([
                'success' => true,
                'palabra' => $correcta['palabraFaltante'], // La palabra que falta en la frase
                'idFrase' => $idFrase
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'No hay frase programada para hoy'
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
        if ($this->fraseMod->haJugadoHoy($idUsuario)) {
            echo json_encode([
                'success' => false,
                'error' => 'Ya has jugado la frase del día hoy'
            ]);
            return;
        }

        // Obtener datos del POST
        $idFrase = $_POST['idFrase'] ?? null;
        $temporizador = $_POST['tiempo'] ?? 0;
        $puntuacion = $_POST['puntuacion'] ?? 0;
        $intentos = $_POST['intentos'] ?? 1;

        if (!$idFrase) {
            echo json_encode([
                'success' => false,
                'error' => 'Datos incompletos'
            ]);
            return;
        }

        // Guardar la partida en la base de datos
        $resultado = $this->fraseMod->guardarPartida($idFrase, $temporizador, $puntuacion, $intentos, $idUsuario);

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'mensaje' => 'Partida guardada correctamente',
                'puntuacion' => $puntuacion
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Error al guardar la partida'
            ]);
        }
    }
}
?>