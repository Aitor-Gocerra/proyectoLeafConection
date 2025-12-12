<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Amigos - LeafConnect");
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
                <button type="submit" class="enviarAmigo" id="encontrarAmigo"><i class="fa-solid fa-user-plus"></i>  Enviar Solicitud </button>
            </div>
            <div id="mensaje-error-amigos"></div>
        </div>
        <div id="amigosSolicitudes">
            <button type="submit" class="botonActivo" id="todosAmigos">Mis Amigos</button>
            <button type="submit" class="botonNoActivo" id="solicitudesAmigos">Solicitudes Pendientes</button>
        </div>
        <div id="misAmigos">
            <h2>Lista de Amigos</h2>

            <?php echo empty($amigos) ? '<p>No tienes amigos agregados.</p>' : ''; ?>
            <?php foreach ($amigos as $amigo) { ?>
                    <div id="contenedorAmigo">
                        <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                        
                        <p class="nombreAmigo"><?php echo $amigo['nombreAmigo']  ?></p>
                        
                        <div class="simboloAmigo">
                            <button type="button" class="eliminarAmigo" value="<?php echo $amigo['idAmigo'] ?>">
                                <i class="fa-solid fa-user-minus"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <div id="misSolicitudes">
            <h2>Solicitudes de Amistad</h2>

            <?php if (isset($solicitudes) && !empty($solicitudes)) { ?>
                <?php foreach ($solicitudes as $soli) { ?>
                    <div id="contenedorSolicitudes">
                        <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                        <p class="nombreAmigo"><?php echo $soli['nombreAmigo']; ?></p>
                        <button type="submit" class="aceptarSolicitud" value="<?php echo $soli['idEmisor']; ?>">Aceptar <i class="fa-solid fa-user-check"></i></button>
                        <button type="submit" class="rechazarSolicitud" value="<?php echo $soli['idEmisor']; ?>">Rechazar <i class="fa-solid fa-user-xmark"></i></button>
                    </div>
                    <?php } ?>

                <?php } else { ?>
                <p>No tienes solicitudes nuevas.</p>
            <?php } ?>
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
    <script type="module" src="javaScript/vistas/amigos.js"></script>

        <?php
            require_once 'parciales/modalEliminarAmigo.php';
        ?>

    <script src="javaScript/modelos/mAmigos.js"></script>
    <script src="javaScript/controladores/cAmigos.js"></script>
    <script src="javaScript/vistas/vAmigos.js"></script>
    <script src="javaScript/app.js"></script>
</body>

</html>