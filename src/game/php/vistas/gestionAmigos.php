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
                <form method="POST" action="">
                    <input type="text" name="buscarAmigo" class="introducirAmigo" placeholder="nombredelusuario#1234">
                    <button type="submit" class="enviarAmigo" id="anadirAmigo"><i class="fa-solid fa-user-plus"></i> Enviar Solicitud</button>
                    <div id="mensaje-error"></div>
                </form>
            </div>
        </div>
        <div id="amigosSolicitudes">
            <button type="submit" class="botonActivo" id="todosAmigos">Mis Amigos</button>
            <button type="submit" class="botonNoActivo" id="solicitudesAmigos">Solicitudes Pendientes</button>
        </div>
        <div id="misAmigos">
            <h2>Lista de Amigos</h2>
            <div id="contenedorAmigo">
                <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                <p class="nombreAmigo">Aitor Gomez</p>
                <div class="simboloAmigo">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
            <div id="contenedorAmigo">
                <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                <p class="nombreAmigo">Aitor Gomez</p>
                <div class="simboloAmigo">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
        </div>
        <div id="misSolicitudes">
            <h2>Solicitudes de Amistad</h2>
            <div id="contenedorSolicitudes">
                <img src="./imagenes/fotoPerfil.jpg" class="fotoAmigo">
                <p class="nombreAmigo">Aitor Gomez</p>
                <button type="submit" class="aceptarSolicitud">Aceptar <i
                        class="fa-solid fa-user-check"></i></button></i>
                <button type="submit" class="rechazarSolicitud">Rechazar <i class="fa-solid fa-user-xmark"></i></button>
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
    <script >
        const btnAmigos = document.getElementById("todosAmigos");
        const btnSolicitudes = document.getElementById("solicitudesAmigos");
        const misAmigos = document.getElementById("misAmigos");
        const misSolicitudes = document.getElementById("misSolicitudes");

        btnAmigos.addEventListener("click", () => {
            misAmigos.style.display = "block";
            misSolicitudes.style.display = "none";

            btnAmigos.classList.add("botonActivo");
            btnAmigos.classList.remove("botonNoActivo");

            btnSolicitudes.classList.add("botonNoActivo");
            btnSolicitudes.classList.remove("botonActivo");
        });

        btnSolicitudes.addEventListener("click", () => {
            misAmigos.style.display = "none";
            misSolicitudes.style.display = "block";

            btnSolicitudes.classList.add("botonActivo");
            btnSolicitudes.classList.remove("botonNoActivo");

            btnAmigos.classList.add("botonNoActivo");
            btnAmigos.classList.remove("botonActivo");
        });

    </script>
    <script type="module" src="javascript/vista/amigos.js"></script>
</body>

</html>