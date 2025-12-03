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
                    <p>"La mayor amenaza para nuestro planeta es la creencia de que alguien mas lo ______".</p>
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
            document.addEventListener('DOMContentLoaded', () => {
    
    const iconoPista = document.querySelector('.iconoPista');
    const popup = document.getElementById('popupPista');
    const cerrarPopup = document.getElementById('cerrarPopup');

    
    iconoPista.addEventListener('click', () => {
        popup.style.display = 'block';
    });

    
    cerrarPopup.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    
    window.addEventListener('click', (event) => {
        
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});
        </script>
    
    </body>
</html>