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

        <!-- Añadir Usuario -->
        <div id="contenedorAdmin">
            <h1>Añadir Usuario</h1>
            <form action="index.php?c=Usuarios&m=anadirUsuario" method="post">
                <label for="nombreUsuario">Nombre</label>
                <input type="text" name="nombre" id="nombreUsuario" placeholder="Introducir nombre del usuario"
                    required>

                <label for="correoUsuario">Correo</label>
                <input type="email" name="correo" id="correoUsuario" placeholder="Introducir correo" required>

                <label for="passUsuario">Contraseña</label>
                <input type="password" name="password" id="passUsuario" placeholder="Introducir contraseña" required>

                <input type="submit" value="Añadir usuario">
            </form>
        </div>

        <!-- Modificar Estado de Usuario -->
        <div id="contenedorAdmin">
            <h1>Gestionar Usuarios (Estado)</h1>
            <form action="index.php?c=Usuarios&m=modificarEstado" method="post">
                <label for="buscarUsuarioEstado">Buscar usuario (Nombre o Correo EXACTO)</label>
                <input type="search" name="buscar" id="buscarUsuarioEstado" placeholder="Buscar..." autocomplete="off"
                    required>

                <label>Estado</label>
                <ul>
                    <li><input type="radio" name="estado" value="1" required> Activo</li>
                    <li><input type="radio" name="estado" value="0"> Detenido</li>
                </ul>

                <input type="submit" value="Modificar estado">
            </form>
        </div>

        <!-- Eliminar Usuario -->
        <div id="contenedorAdmin">
            <h1>Eliminar Usuario</h1>
            <form action="index.php?c=Usuarios&m=eliminarUsuario" method="post"
                onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
                <label for="buscarUsuarioEliminar">Buscar usuario (Nombre o Correo EXACTO)</label>
                <input type="search" name="buscar" id="buscarUsuarioEliminar" placeholder="Buscar..." autocomplete="off"
                    required>

                <input type="submit" value="Eliminar usuario">
            </form>
        </div>

        <!-- LISTADO DE USUARIOS -->
        <div id="contenedorAdmin">
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
                        <?php foreach ($usuarios as $user) { ?>
                            <tr>
                                <td><?php echo $user['idUsuario']; ?></td>
                                <td><?php echo $user['nombre']; ?></td>
                                <td><?php echo $user['correo']; ?></td>
                                <td><?php echo ($user['estado'] == 1) ? 'Activo' : 'Detenido/Inactivo'; ?></td>
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