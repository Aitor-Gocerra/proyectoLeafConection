<?php
require_once __DIR__ . '/../modelos/mConsejo.php';

class CConsejo
{
    private $objConsejo;
    public $consejo; 
    public $vista;

    public function __construct()
    {
        $this->objConsejo = new Consejo(); 
        $this->vista = '';
    }

    public function cargaDatosJuego()
    {
        $this->vista = 'consejoDia';

        $datosConsejo = $this->objConsejo->mostrarConsejo();
        if ($datosConsejo && isset($datosConsejo['consejo'])) {
            $this->consejo = $datosConsejo['consejo'];
        } else {
            $this->consejo = "No hay consejo programado para la fecha de hoy.";
        }

        return [
            'consejo' => $this->consejo,
        ];
    }
}