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
}
?>