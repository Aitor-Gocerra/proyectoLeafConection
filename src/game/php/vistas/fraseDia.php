<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Frase del día - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>
        <main>
            <div id="cajaPalabra">
                <h2 class="tituloPalabra">Frase del día</h2>
                <p class="descripcionPalabra">Rellena el espacio en blanco para completar la cita ecologica.</p>
                <div class="contenedor-timer-pista">
                    <p class="temporizador"><i class="fas fa-clock"></i> 5:00</p>
                    <button id="btnPista" class="boton-bombilla" title="Ver pista extra">
                        <i class="fas fa-lightbulb"></i>
                    </button>
                </div>
                <div class="pista">
                    <p><?php echo isset($frase['definicion']) ? $frase['definicion'] : 'No hay palabra disponible.'; ?></p>
                </div>
                <div class="contenedorAcierto">
                    <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
                    <button type="submit" class="enviarPalabra">Enviar</button>
                </div>
            </div>

            <?php
                require_once 'parciales/modalPista.php';
            ?>
            
        </main>
        
        <?php
             require_once 'parciales/botonVolver.php';
        ?>


        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>

        <script src="../../javascript/menuDesplegable.js"></script>
    </body>
</html>