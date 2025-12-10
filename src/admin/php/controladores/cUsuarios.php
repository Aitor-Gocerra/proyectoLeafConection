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

        // Ideally I'd need an ID. But the form doesn't provide it hiddenly unless I change the view logic to be: Search -> Show List -> Click Modify.
        // BUT, the View currently has 3 separate blocks: Add, Modify, Delete.
        // This implies the action is independent.
        // I will first Search for users matching.
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
        // This is for a general search if implemented, or maybe called by view?
        // In cFrase logic, there was a specific route.
        // Here, the view doesn't have a main search bar for listing, but "gestionarUsuarios.php" has "parciales/navegador.php".
        // I'll leave this basic or reuse.
        return $this->gestionarUsuarios(); // Helper
    }
}
?>