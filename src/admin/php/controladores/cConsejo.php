<?php
require_once __DIR__ . '/../modelos/mConsejo.php';

class CConsejo
{
    public $vista;
    public $objConsejo;

    public function __construct()
    {
        $this->objConsejo = new Consejo();
        $this->vista = '';
    }


public function listarTematicas()
{
    $this->vista = 'gestionarConsejo'; 
    
    $listaTematicas = $this->objConsejo->listarTematicas();
    return [
        'tematicas' => $listaTematicas,
    ];
}

    public function gestionarConsejo()
    {
        $this->vista = 'gestionarConsejo';
        
        // Llamar a la función del modelo para obtener los datos
        $listaTematicas = $this->objConsejo->listarTematicas(); 

        // Devolver los datos para que la vista los use
        return [
            'tematicas' => $listaTematicas,
        ];
    }

    public function guardarConsejo() {
    
    $textoConsejo = $_POST['consejo'] ?? null;         
    $idTematica = $_POST['idTematicaConsejo'] ?? null;
    $fecha = $_POST['fechaProgramada'] ?? null;

    $this->vista = 'gestionarConsejo';

    if (empty($textoConsejo) || empty($idTematica) || empty($fecha)) {
        return ['resultado' => false, 'mensaje' => 'Faltan datos obligatorios.'];
    }

    $resultado = $this->objConsejo->insertarConsejo($textoConsejo, $idTematica, $fecha);

    if ($resultado) {
        // Éxito: Volvemos a listar las temáticas y enviamos un mensaje de éxito
        $listaTematicas = $this->objConsejo->listarTematicas();
        
        return [
            'tematicas' => $listaTematicas,
            'mensaje' => 'El consejo se guardó correctamente.'
        ];
    } else {
        // Fallo en la base de datos
        $listaTematicas = $this->objConsejo->listarTematicas();

        return [
            'tematicas' => $listaTematicas,
            'mensaje' => 'Error al guardar el consejo en la BD.'
        ];
    }
}
}