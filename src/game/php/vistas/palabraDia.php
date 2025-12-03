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
            <div class="contenedor-timer-pista">
                <p class="temporizador"><i class="fas fa-clock"></i> 5:00</p>
                <button id="btnPista" class="boton-bombilla" title="Ver pista extra">
                    <i class="fas fa-lightbulb"></i>
                </button>
            </div>
            <div class="pista">
                <p><?php echo isset($palabra['definicion']) ? $palabra['definicion'] : 'No hay palabra disponible.'; ?>
                </p>
            </div>
            <div class="contenedorAcierto">
                <input type="text" name="acertarPalabra" class="introducirPalabra" placeholder="Tu suposición...">
                <button type="submit" class="enviarPalabra">Acierta</button>
            </div>
            <div id="zonaRespuesta" style="display: none; text-align: center; margin-top: 15px;">
                <p>La respuesta correcta es:</p>
                <h3 id="textoSolucion" style="color: #27ae60; text-transform: uppercase;"></h3>
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

    <script>
        // Obtener elementos
        const modal = document.getElementById("modalPista");
        const btn = document.getElementById("btnPista");
        const span = document.getElementsByClassName("cerrar-modal")[0];

        // Cuando el usuario hace clic en la bombilla, abre el modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // Cuando el usuario hace clic en (x), cierra el modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic fuera del modal, también se cierra
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        //
    </script>
</body>

</html>