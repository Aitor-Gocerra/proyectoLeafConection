<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestion de Noticia - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>

         <main id="noticia_panel" class="contenedor_noticia">
        <div class="noticia_titulo">
                <h1>Gestión de noticias</h1>
        </div>
        <form action="" method="post" id="noticia_formulario">
            <label for="">Nombre</label>
            <input type="text" name="" id="" placeholder="Ej: Greta Thunberg">

            <label for="">Contenido</label>
            <textarea name="contenido" id="contenido" rows="5"></textarea>

            <label for="">URL de la imagen</label>
            <input type="url" name="url" id="url">

            <label for="">Fecha programada</label>
            <input type="date" name="fecha" id="fecha">

            <label for="">Cuestionario</label>

            <div class="cuestionario_pregunta">
                <label for="">Pregunta</label>
                <input type="text" name="" id="">

                <label for="">Opciones (separadas por '/')</label>
                <input type="text" name="opciones" id="opciones">

                <label for="">Respuesta correcta</label>
                <input type="number" name="respuesta_correcta" id="">
            </div>

            <input type="submit" value="Guardar noticia">
            
        </form>
        <button id="añadirPregunta"><i class="fa-regular fa-square-plus"></i> Añadir Pregunta</button>
    </main>

        <a href="index.html" id="enlaceVolver">
            <i class="fas fa-arrow-left"></i> Salir
        </a>

        <footer>
            <p>&copy; 2025-2026 LeafConection. Todos los derechos reservados.</p>
        </footer>

        <script src="../javascript/anadirPregunta.js"></script>
    </body>
</html>