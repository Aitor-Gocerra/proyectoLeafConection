<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestion de Frase - LeafConnect");
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
                titulo("Frase");
            ?>
            <div id="contenedorAdmin">
                <h1>Añadir/Editar Frase del Dia</h1>
                <form action="" method="get">
                    <label for="frase">Frase</label>
                    <input type="text" name="frase" id="frase" placeholder="Ej: La Tierra no es una herencia de nuestros padres, sino un prestamo de nuestros _____.">
                    <p>Usa '___' para el lugar donde ira la palabra que falta</p>

                    <label for="palabra">Palabra que falta</label>
                    <input type="text" name="" id="palabra" placeholder="Ej: hijos">

                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" placeholder="Ej: Provervio nativo americano">

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

                    <input type="submit" value="Guardar Frase">
                </form>

                
            </div>
            <div id="ultimasDiezFrases">
                Aqui mostraremos con JS, las 10 ultimas frases que se han introducido
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