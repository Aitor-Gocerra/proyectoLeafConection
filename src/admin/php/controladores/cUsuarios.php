<?php
require_once __DIR__ . '/../modelos/mUsuarios.php';

class CUsuarios
{
    private $modelo;
    public $mensaje;
    public $usuariosList;
    public $vista;

    public function __construct()
    {
        $this->modelo = new Usuarios();
        $this->vista = '';
    }

    public function listarUsuarios()
    {
        $this->usuariosList = $this->modelo->listarUsuarios();
    }

    public function gestionarUsuarios()
    {
        $this->vista = 'gestionarUsuarios';
        $this->listarUsuarios();
        return ['usuarios' => $this->usuariosList, 'mensaje' => $this->mensaje];
    }

    public function anadirUsuario()
    {
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($nombre) || empty($correo) || empty($password)) {
            $this->mensaje = "Error: Rellena todos los campos.";
            return $this->gestionarUsuarios();
        }

        $id = $this->modelo->anadirUsuario($nombre, $correo, $password);

        if ($id) {
            $this->mensaje = "Usuario añadido correctamente.";
        } else {
            $this->mensaje = "Error al añadir usuario.";
        }

        return $this->gestionarUsuarios();
    }

    public function modificarEstado()
    {
        $busqueda = $_POST['busqueda'] ?? ''; 

        $buscar = $_POST['buscar'] ?? '';
        $estado = $_POST['estado'] ?? null;

        if (empty($buscar) || !isset($estado)) {
            $this->mensaje = "Introduce un usuario y selecciona un estado.";
            return $this->gestionarUsuarios();
        }

        $usuarios = $this->modelo->buscarUsuarios($buscar);

        if (count($usuarios) == 1) {
            $id = $usuarios[0]['idUsuario'];
            $ok = $this->modelo->modificarEstadoUsuario($id, $estado);
            $this->mensaje = $ok ? "Estado actualizado correctamente." : "Error al actualizar.";
        } elseif (count($usuarios) > 1) {
            $this->mensaje = "Error: Múltiples usuarios encontrados con ese criterio. Se más específico.";
        } else {
            $this->mensaje = "Error: Usuario no encontrado.";
        }

        return $this->gestionarUsuarios();
    }

    public function buscarUsuarios()
    {
        return $this->gestionarUsuarios(); // Helper
    }
}
?>