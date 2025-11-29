<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Gestión de amigos - LeafConnect");
    ?>
</head>

<body>
    <header>
        <nav>
            <?php
            require_once 'parciales/nav.php';
            ?>
        </nav>
    </header>
    <main>
        <div id="tituloAmigos">
            <h1>Gestión de amigos</h1>
        </div>
        <div id="anadirAmigo">
            <h2>Añadir Nuevo Amigo</h2>
            <p class="descripcion">Busca a tus amigos por nombre de usuario o correo electrónico</p>
            <div class="contenedorBuscarAmigo">
                <input type="text" name="buscarAmigo" class="introducirAmigo" placeholder="nombredelusuario#1234">
                <button type="submit" class="enviarAmigo"><i class="fa-solid fa-user-plus"></i> Enviar Solicitud
                </button>
            </div>
        </div>
        <div id="amigosSolicitudes">
            <button type="submit" class="botonActivo" id="todosAmigos">Mis Amigos</button>
            <button type="submit" class="botonNoActivo" id="solicitudesAmigos">Solicitudes Pendientes</button>
        </div>
        <div id="misAmigos">
            <h2>Lista de Amigos</h2>
            <div id="contenedorAmigo">
                <img src="../imagenes/lolilla.png" class="fotoAmigo">
                <p class="nombreAmigo">Elena García</p>
                <button type="submit" class="estadoAmigoOnline">Online</button>
                <div class="simboloAmigo">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
            <div id="contenedorAmigo">
                <img src="../imagenes/lolilla.png" class="fotoAmigo">
                <p class="nombreAmigo">Elena García</p>
                <button type="submit" class="estadoAmigoOffline">Offline</button>
                <div class="simboloAmigo">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
        </div>
        <div id="misSolicitudes">
            <h2>Solicitudes de Amistad</h2>
            <div id="contenedorSolicitudes">
                <img src="../imagenes/lolilla.png" class="fotoAmigo">
                <p class="nombreAmigo">Elena García</p>
                <button type="submit" class="aceptarSolicitud">Aceptar <i
                        class="fa-solid fa-user-check"></i></button></i>
                <button type="submit" class="rechazarSolicitud">Rechazar <i class="fa-solid fa-user-xmark"></i></button>
            </div>
        </div>
    </main>
    <script src="javaScript/amigosSolicitudes.js"></script>
</body>

</html>