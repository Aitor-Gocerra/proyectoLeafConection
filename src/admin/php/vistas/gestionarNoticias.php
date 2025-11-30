<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestión de Noticia - LeafConnect");
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
                titulo("Noticia");
            ?>

            <div id="contenedorAdmin">
                <h1>Gestión de noticias</h1>
                <form action="" method="post" id="noticia_formulario">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ej: Greta Thunberg">

                    <label for="contenido">Contenido</label>
                    <textarea name="contenido" id="contenido" rows="5" placeholder="Escribe el contenido de la noticia"></textarea>

                    <label for="url">URL de la imagen</label>
                    <input type="text" name="url" id="url" placeholder="Ej: https://...">

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <label>Cuestionario</label>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pregunta</label>
                            <input type="text" name="pregunta[]" placeholder="Escribe la pregunta">

                            <label>Opciones (separadas por '/')</label>
                            <input type="text" name="opciones[]" class="opciones" placeholder="Opción1/Opción2/Opción3">

                            <label>Respuesta correcta</label>
                            <input type="number" name="respuesta_correcta[]" min="1" placeholder="Número de la respuesta correcta">
                        </div>
                    </div>

                    <input type="submit" value="Guardar noticia">
                </form>

                <button type="button" id="añadirPregunta">
                    <i class="fa-regular fa-square-plus"></i> Añadir Pregunta
                </button>
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
