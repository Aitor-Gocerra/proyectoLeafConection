<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestion de Palabras - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>           
        <main>
            <?php
                require_once 'parciales/navegador.php';
            ?>

            <?php
                require_once 'parciales/buscador.php';
                titulo("Palabra");
            ?>


            <div id="contenedorAdmin">
                <h1>Añadir/Editar Palabra del Dia</h1>
                <form action="" method="get">
                    <label for="palabra">Palabra</label>
                    <input type="text" name="palabra" id="palabra" placeholder="Ej: Arból...">
                    <p>Añade una palabra para que sea adivinada.</p>

                    <label for="definicion">Definición</label>
                    <input type="text" name="" id="definicion" placeholder="Ej: Planta de tallo leñoso y elevado, que se ramifica a cierta altura del suelo.">

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <button type="button" id="añadirPregunta">
                        <i class="fa-regular fa-square-plus"></i> Añadir Pregunta
                    </button>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pista</label>
                            <input type="text" name="pista[]" placeholder="Pista...">
                        </div>
                    </div>

                    <input type="submit" value="Guardar Palabra">
                </form>

            </div>
        </main>
        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>

        <script src="./javascript/anadirPregunta.js"></script>
    </body>
</html>