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
                
                <p id="fraseConsejo">
                    <?php echo $consejo ?? 'Cargando consejo...'; ?>
                </p>
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