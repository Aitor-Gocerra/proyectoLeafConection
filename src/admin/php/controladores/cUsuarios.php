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
        $busqueda = $_POST['busqueda'] ?? ''; // Assuming search from the modification might be needed, but form just has 'buscar' and radio.
        // Wait, the form has a search box "buscarUsuarioEstado" with name="buscar" and radios "estado".
        // But to modify state I need to know WHICH user.
        // The view design in `gestionarUsuarios.php` seems to imply a Bulk Update or searching first?
        // Let's re-read the view.
        /* 
           <!-- Modificar Estado de Usuario -->
           <div id="contenedorAdmin">
               <h1>Gestionar Usuarios</h1>
               <form action="" method="post">
                   <label for="buscarUsuarioEstado">Buscar usuario</label>
                   <input type="search" name="buscar" id="buscarUsuarioEstado" placeholder="Buscar..." autocomplete="off">

                   <label>Estado</label>
                   <ul>
                       <li><input type="radio" name="estado" value="activo"> Activo</li>
                       <li><input type="radio" name="estado" value="detenido"> Detenido</li>
                   </ul>

                   <input type="submit" value="Modificar estado">
               </form>
           </div>
        */
        // This form seems to search AND modify? Or maybe it expects to search, find a user, and then modify?
        // But the input is just text. If uniqueness is not guaranteed by name, this is risky. Use email?
        // I'll implement it as: Find user by EXACT match of Name or Email provided in 'buscar', then update.
        // Or maybe just partial match? But that would update multiple users.
        // Given the simplistic UI, I'll assume exact match or maybe it's just searching to populate a list (but the form submits "Modificar estado").
        // Actually, normally you list users and click a button next to them. But here the UI is "Search + Radio + Submit".
        // This implies "Apply 'estado' to user 'buscar'".
        // I will try to find a user with that exact name or email. If ambiguous, I might error or update all.
        // I'll check strict match.

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

    public function eliminarUsuario()
    {
        $buscar = $_POST['buscar'] ?? '';

        if (empty($buscar)) {
            $this->mensaje = "Buscador vacío.";
            return $this->gestionarUsuarios();
        }

        // Similar logic to modify
        $usuarios = $this->modelo->buscarUsuarios($buscar);

        if (count($usuarios) == 1) {
            $id = $usuarios[0]['idUsuario'];
            $ok = $this->modelo->eliminarUsuario($id);
            $this->mensaje = $ok ? "Usuario eliminado correctamente." : "Error al eliminar.";
        } elseif (count($usuarios) > 1) {
            $this->mensaje = "Error: Múltiples usuarios encontrados. Se más específico.";
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