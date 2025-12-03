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
        <?php
            require_once 'parciales/nav.php';
        ?>
    </header>
    <main>
        <div id="tituloAmigos">
            <h1>Gestión de amigos</h1>
        </div>
        <div id="anadirAmigo">
            <h2>Añadir Nuevo Amigo</h2>
            <p class="descripcion">Busca a tus amigos por nombre de usuario o correo electrónico</p>
            <div class="contenedorBuscarAmigo">
                <input type="text" name="buscarAmigo" class="introducirAmigo" placeholder="nombredelusuario#1234" id="introducirAmigo">
                <button type="submit" class="enviarAmigo" id="encontrarAmigo"><i class="fa-solid fa-user-plus"></i> Enviar Solicitud</button>
            </div>
            <div id="mensaje-error-amigos"></div>
        </div>
        <div id="amigosSolicitudes">
            <button type="submit" class="botonActivo" id="todosAmigos">Mis Amigos</button>
            <button type="submit" class="botonNoActivo" id="solicitudesAmigos">Solicitudes Pendientes</button>
        </div>
        <div id="misAmigos">
            <h2>Lista de Amigos</h2>
            <div id="contenedorAmigo"><!-- Aquí se verian los amigos agregados se debe de hacer las dos de maner dinámica-->
                <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                <p class="nombreAmigo">Aitor Gomez</p>
                <div class="simboloAmigo">
                    <button type="submit" class="eliminarAmigo" id="eliminarAmigoBtn"><i class="fa-solid fa-user-minus"></i>
                </div>
            </div>
        </div>
        <div id="misSolicitudes">
            <h2>Solicitudes de Amistad</h2>
            <div id="contenedorSolicitudes">
                <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                <p class="nombreAmigo">Aitor Gomez</p> <!-- Aquí se verian el amigo y deberiamosde coger su id para aceptar o rechazar su solicitud-->
                <button type="submit" class="aceptarSolicitud" id="btnAceptarSolicitud">Aceptar <i class="fa-solid fa-user-check"></i></button></i>
                <button type="submit" class="rechazarSolicitud" id="btnRechazarSolicitud" >Rechazar <i class="fa-solid fa-user-xmark"></i></button>
            </div>
        </div>
    </main>
        <?php
            require_once 'parciales/botonVolver.php';
        ?>
    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>

    <div id="confirmModal" class="modal-overlay-simple">
        <div class="modal-content-simple">
            <h3>¿Estás seguro?</h3>
            <p>Esta acción eliminará a tu amigo permanentemente.</p>
            
            <div class="modal-actions-simple">
                <button type="button" id="cancelBtn" class="modal-btn-simple">Cancelar</button>
                <button type="button" id="confirmDeleteBtn" class="modal-btn-simple modal-btn-delete-simple">Eliminar</button>
            </div>
        </div>
    </div>
    <script type="module" src="javascript/vista/amigos.js"></script>
</body>

</html>