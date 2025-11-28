<!DOCTYPE html>
<html>
    <?php
        require_once 'parciales/head.php';
        encabezado("Palabra del día - LeafConnect");
    ?>
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
                <p class="temporizador"><i class="fas fa-clock"></i> </i>5:00</p>
                <div class="pista">
                    <p>El proceso de reciclaje de materia orgánica, como hojas y restos de comida, en una enmienda rica para el suelo.</p>
                </div>
                    <div class="contenedorAcierto">
                        <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
                        <button type="submit" class="enviarPalabra">Acierta</button>
                    </div>
            </div>
        </main>
        
        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>
    </body>
</html>