<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Gestión de Usuarios - LeafConnect");
    ?>
</head>

<body>
    <header>
        <?php require_once 'parciales/nav.php'; ?>
    </header>

    <main>
        <?php
        require_once 'parciales/navegador.php';
        ?>

        <!-- Grid para formularios -->
        <div class="admin-grid">
            <!-- Añadir Usuario -->
            <div class="contenedor-admin">
                <h1>Añadir Administrador</h1>
                <form action="index.php?c=Usuarios&m=anadirUsuario" method="post">
                    <label for="nombreUsuario">Nombre</label>
                    <input type="text" name="nombre" id="nombreUsuario" placeholder="Introducir nombre del usuario"
                        required>

                    <label for="correoUsuario">Correo</label>
                    <input type="email" name="correo" id="correoUsuario" placeholder="Introducir correo" required>

                    <label for="passUsuario">Contraseña</label>
                    <input type="password" name="password" id="passUsuario" placeholder="Introducir contraseña"
                        required>

                    <input type="submit" value="Añadir administrador">
                </form>
            </div>

            <!-- Modificar Estado de Usuario -->
            <div class="contenedor-admin">
                <h1>Gestionar Usuarios (Estado)</h1>
                <form action="index.php?c=Usuarios&m=modificarEstado" method="post">
                    <label for="buscarUsuarioEstado">Buscar usuario (Nombre o Correo EXACTO)</label>
                    <input type="search" name="buscar" id="buscarUsuarioEstado" placeholder="Buscar..."
                        autocomplete="off" required>

                    <label>Estado</label>
                    <ul>
                        <li><input type="radio" name="estado" value="1" required> Activo</li>
                        <li><input type="radio" name="estado" value="0"> Detenido</li>
                    </ul>

                    <input type="submit" value="Modificar estado">
                </form>
            </div>
        </div>

        <!-- LISTADO DE USUARIOS -->
        <div id="listadoUsuarios" class="contenedor-admin">
            <h1>Listado de Usuarios</h1>
            <?php if (isset($usuarios) && !empty($usuarios)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['idUsuario']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['correo']; ?></td>
                                <td><?php echo ($usuario['estado'] == 1) ? 'Activo' : 'Detenido/Inactivo'; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay usuarios registrados.</p>
            <?php } ?>
        </div>

        <!-- Mensajes -->
        <?php if (isset($mensaje) && !empty($mensaje)) { ?>
            <div id="notificacion"
                style="opacity: 1; position: fixed; bottom: 20px; right: 20px; background: #333; color: white; padding: 15px; border-radius: 5px; z-index: 1000;">
                <p><?php echo $mensaje; ?></p>
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById("notificacion").style.opacity = "0";
                }, 3000);
            </script>
        <?php } ?>

    </main>
    <footer>
        <?php require_once 'parciales/footer.php'; ?>
    </footer>
    <script src="../javascript/menuDesplegable.js"></script>
</body>

</html>