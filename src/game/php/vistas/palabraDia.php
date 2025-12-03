<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Palabra del día - LeafConnect");
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
                <h2 class="tituloPalabra">Palabra del día</h2>
                <p class="descripcionPalabra">Usa la siguiente definición para adivinar la eco-palabra.</p>
                
                <div class="contenedorTiempoPista">
                <p id="temporizador"><i class="fas fa-clock"></i> </i>5:00</p>
                
            <i class="fas fa-lightbulb fa-2x" id="iconoPista"></i> 
            </div>
            <div id="popupPista" class="popup">
            <div class="popup-contenido">
        <span id="cerrarPopup" class="cerrar"></span>
        <p>Esta pista te ayudará a descubrir la eco-frase del día.</p>
            </div>
            </div>
            
        
                
                <div class="frase">
                    <p>El proceso de reciclaje de materia orgánica, como hojas y restos de comida, en una enmienda rica para el suelo.</p>
                </div>

                    <div class="contenedorAcierto">
                        <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
                        <button type="submit" class="enviarPalabra">Acierta</button>
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
    </body>
</html>