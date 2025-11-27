<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require_once './parciales/head.php';
            encabezado("Frase del día - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once './parciales/nav.php';
            ?>
        </header>
        <main>
            <div id="cajaPalabra">
                <h2 class="tituloPalabra">Frase del día</h2>
                <p class="descripcionPalabra">Rellena el espacio en blanco para completar la cita ecologica.</p>
                <p class="temporizador"><i class="fas fa-clock"></i> </i>5:00</p>
                <div class="pista">
                    <p>"La mayor amenaza para nuestro planeta es la creencia de que alguien mas lo ______".</p>
                </div>
                    <div class="contenedorAcierto">
                        <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
                        <button type="submit" class="enviarPalabra">Enviar</button>
                    </div>
            </div>
        </main>
        
        <footer>
            <?php
                require_once './parciales/footer.php';
            ?>
        </footer>

        <script src="../../javascript/menuDesplegable.js"></script>
    </body>
</html>