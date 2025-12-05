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

    public function obtenerPalabraJSON() {
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
}
?>