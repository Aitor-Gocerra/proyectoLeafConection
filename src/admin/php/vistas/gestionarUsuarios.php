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
            <form action="" method="post">
                <label for="nombreUsuario">Nombre</label>
                <input type="text" name="nombre" id="nombreUsuario" placeholder="Introducir nombre del usuario">

                <label for="correoUsuario">Correo</label>
                <input type="email" name="correo" id="correoUsuario" placeholder="Introducir correo">

                <label for="passUsuario">Contraseña</label>
                <input type="password" name="password" id="passUsuario" placeholder="Introducir contraseña">

                <input type="submit" value="Añadir usuario">
            </form>
        </div>

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

        <!-- Eliminar Usuario -->
        <div id="contenedorAdmin">
            <h1>Eliminar Usuario</h1>
            <form action="" method="post">
                <label for="buscarUsuarioEliminar">Buscar usuario</label>
                <input type="search" name="buscar" id="buscarUsuarioEliminar" placeholder="Buscar..." autocomplete="off">

                <input type="submit" value="Eliminar usuario">
            </form>
        </div>

    </main>
    <footer>
        <?php require_once 'parciales/footer.php'; ?>
    </footer>
    <script src="../javascript/menuDesplegable.js"></script>
</body>
</html>
