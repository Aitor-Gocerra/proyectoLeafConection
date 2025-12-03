<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Inicio - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>

        <main>
            <h1>¡Bienvenido, Usuario!</h1>
            <p>Elige un desafío a continuación para empezar a aprender y a divertirte</p>
            
            <div id="contenedorTarjetas">
                <div class="tarjetaJuego">
                    <i class="fas fa-puzzle-piece"></i>
                    <h2 class="tituloTarjeta">Palabra del dia</h2>
                    <p class="descripcionTarjeta">Adivina la eco-palabra del dia</p>
                    <a href="index.php?c=Paginas&m=palabraDia">Comenzar desafío</a>
                </div>

                <div class="tarjetaJuego">
                    <i class="fas fa-quote-left"></i>
                    <h2 class="tituloTarjeta">Frase del dia</h2>
                    <p class="descripcionTarjeta">Completa la cita inspiradora</p>
                    <a href="index.php?c=Paginas&m=fraseDia">Comenzar desafío</a>
                </div>

                <div class="tarjetaJuego">
                    <i class="fas fa-globe"></i>
                    <h2 class="tituloTarjeta">Noticia del día</h2>
                    <p class="descripcionTarjeta">Aprende sobre la noticia eco-ambiental del dia</p>
                    <a href="index.php?c=Noticias&m=noticiaDia">Comenzar desafío</a>
                </div>

                <div class="tarjetaJuego">
                    <i class="fas fa-recycle"></i>
                    <h2 class="tituloTarjeta">Consejo del día</h2>
                    <p class="descripcionTarjeta">Lee el consejo diario sobre la salud mental y ambiental</p>
                    <a href="index.php?c=Paginas&m=consejoDia">Comenzar desafío</a>
                </div>
            </div>
        </main>

        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>

        <script src="./javaScript/menuDashboardUsuario.js"></script>
    </body>
</html>