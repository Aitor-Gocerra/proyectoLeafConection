<?php
require_once __DIR__ . '/../modelos/mConsejo.php';

class CConsejo
{
    private $consejoMod;
    public $mensaje;
    public $consejosList;
    public $vista;

    public function __construct()
    {
        $this->consejoMod = new Consejo();
        $this->vista = '';
        $this->mensaje = '';
    }

    public function listarConsejos()
    {
        $this->consejosList = $this->consejoMod->listarConsejos();
    }

    public function gestionarConsejo()
    {
        $this->vista = 'gestionarConsejo';
        $this->listarConsejos();
        return [
            'consejos' => $this->consejosList,
            'mensaje' => $this->mensaje
        ];
    }

    public function buscarConsejos()
    {
        $this->vista = 'gestionarConsejo';
        $buscar = $_GET['buscar'] ?? '';

        if (empty(trim($buscar))) {
            $this->mensaje = "Por favor, introduce un término de búsqueda.";
            return ['mensaje' => $this->mensaje];
        }

        $resultados = $this->consejoMod->buscarConsejos($buscar);
        $this->listarConsejos();

        return [
            'resultadosBusqueda' => $resultados,
            'consejos' => $this->consejosList,
            'mensaje' => $this->mensaje
        ];
    }

    public function guardarNuevaConsejo()
    {
        // Recoger datos
        $consejo = $_POST['consejo'] ?? '';
        $idTematica = $_POST['idTematicaConsejo'] ?? '';
        $fecha = $_POST['fechaProgramada'] ?? null;

        // Validación simple
        if (empty(trim($consejo)) || empty(trim($idTematica)) || empty($fecha)) {
            $this->mensaje = "Error: Faltan campos obligatorios para el consejo.";

            return $this->gestionarConsejo();
        }

        // Intentar crear
        $id = $this->consejoMod->crearConsejo($consejo, $idTematica, $fecha);
        if ($id) {
            $this->mensaje = "Consejo guardado correctamente con ID: " . $id;
        } else {
            $this->mensaje = "Error al guardar el consejo. Revise logs de base de datos.";
        }

        return $this->gestionarConsejo();
    }

    public function editarConsejo()
    {
        $this->vista = 'gestionarConsejo';
        $id = $_GET['idConsejo'] ?? null;
        $usarModal = isset($_GET['modal']) && $_GET['modal'] == '1';

        $consejoEditar = null;
        if ($id) {
            $consejoEditar = $this->consejoMod->obtenerConsejo($id);
        }

        $this->listarConsejos();

        // también listar temáticas para el select en el formulario
        $tematicas = $this->consejoMod->listarTematicas();

        return [
            'consejos' => $this->consejosList,
            'mensaje' => $this->mensaje,
            'consejoEditar' => $consejoEditar,
            'tematicas' => $tematicas,
            'usarModal' => $usarModal
        ];
    }

    public function actualizarConsejo()
    {
        if (empty($_POST['idConsejoEdicion']) || empty($_POST['consejo']) || empty($_POST['idTematicaConsejo'])) {
            $this->mensaje = "Error: rellena todos los campos.";
            return $this->gestionarConsejo();
        }

        $id = $_POST['idConsejoEdicion'];
        $consejo = trim($_POST['consejo']);
        $idTematica = $_POST['idTematicaConsejo'];
        $fecha = $_POST['fechaProgramada'] ?? null;

        $ok = $this->consejoMod->actualizarConsejo($id, $consejo, $idTematica, $fecha);

        if ($ok) {
            $this->mensaje = "Consejo actualizado correctamente.";
        } else {
            $this->mensaje = "Error al actualizar el consejo.";
        }

        return $this->gestionarConsejo();
    }

    public function eliminarConsejo()
    {
        $id = $_REQUEST['idConsejo'] ?? null;

        if (empty($id)) {
            $this->mensaje = "No se proporcionó ID para eliminar";
            return $this->gestionarConsejo();
        }

        $exito = $this->consejoMod->eliminarConsejo($id);
        if ($exito) {
            $this->mensaje = 'Consejo ID: ' .$id. ' eliminado correctamente.';
        } else {
            $this->mensaje = "Error al eliminar el consejo.";
        }

        return $this->gestionarConsejo();
    }

    public function actualizarFechas()
    {
        $exito = $this->consejoMod->actualizarFechas();

        if ($exito) {
            $mensaje = "Fechas actualizadas correctamente";
            header("Location: index.php?c=Consejo&m=gestionarConsejo&success=" . urlencode($mensaje));
        } else {
            $mensaje = "Error al actualizar fechas";
            header("Location: index.php?c=Consejo&m=gestionarConsejo&error=" . urlencode($mensaje));
        }
    }
}
