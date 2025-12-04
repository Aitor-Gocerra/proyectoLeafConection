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
                
                 <div class="contenedorTiempoPista">
                <p id="temporizador">
                <i class="fas fa-clock"></i> 
                <span id="tiempoRestante">5:00</span></p>
                
            <i class="fas fa-lightbulb fa-2x" id="iconoPista"></i> 
            </div>
            <div id="popupPista" class="popup">
            <div class="popup-contenido">
        <span id="cerrarPopup" class="cerrar"></span>
        <p>Esta pista te ayudará a descubrir la eco-frase del día.</p>
            </div>
            </div>

                <div class="frase">
                    <p>"La mayor amenaza para nuestro planeta es la creencia de que alguien mas lo ______".</p>
                </div>
    

        <div class="contenedorAcierto">
            <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
            <button type="submit" class="enviarPalabra">Acierta</button>
        </div>

        <div class="contenedorErrorAcierto">
            <p id="mensaje" style="display:none;"></p>
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
        <script>
            document.querySelector('#iconoPista').addEventListener('click', function() {
            document.getElementById('popupPista').style.display = 'block';
    });

            document.getElementById('cerrarPopup').addEventListener('click', function() {
            document.getElementById('popupPista').style.display = 'none';
});

        // Cerrar si hace clic fuera del popup
        window.addEventListener('click', function(ventana) {
        let popup = document.getElementById('popupPista');
        if (ventana.target === popup) {
        popup.style.display = 'none';
    }
});

        </script>
        <script src="./javaScript/palabraYFraseDia.js"></script>
        <script src="./javaScript/temporizador.js"></script>
    </body>
</html>