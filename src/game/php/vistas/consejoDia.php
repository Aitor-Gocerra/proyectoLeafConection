<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Consejo del día - LeafConnect");
        ?>
    </head>

    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>

        <main>
            
            <div id="cajaConsejo">
                <i class="fa-solid fa-lightbulb" id="bomb"></i>
                <h2 id="tituloConsejo">Consejo del día</h2>
                <p id="fraseConsejo">Separa correctamente tus residuos (orgánico, papel, plástico…).
                Si no separas bien, parte de los residuos reciclables se pierden, lo que implica que más
                basura va a vertederos o al tratamiento común, generando más emisiones</p>
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

        <script src="menuDesplegable.js"></script>
    </body>

</html>