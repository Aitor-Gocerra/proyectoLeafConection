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
            <div id="navegador">
                <a href="gestionarPalabras.html">GESTIONAR PALABRAS</a>
                <a href="gestionarFrases.html">GESTIONAR FRASES</a>
                <a href="gestionarNoticias.html">GESTIONAR NOTICIAS</a>
                <a href="gestionarConsejos.html">GESTIONAR CONSEJOS</a>
                <a href="gestionarUsuarios.html">GESTIONAR USUARIOS</a>
            </div>
            <search id="buscadorFrases">
                <h2>Buscar Frase a Modificar</h2>
                <form action="#" method="get">
                    <input type="search" id="inputBuscar" name="query" placeholder="Introduce una palabra clave o parte de la frase..." aria-label="Buscar frase a modificar">
                    <button type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>
            </search>
            <div id="contenedorModificarFrase">
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

                    <input type="submit" value="Guardar Frase">
                </form>
            </div>
            <div id="ultimasDiezFrases">
                Aqui mostraremos con JS, las 10 ultimas frases que se han introducido
            </div>
        </main>

        <a href="index.html" id="enlaceVolver">
            <i class="fas fa-arrow-left"></i> Salir
        </a>

        <footer>
            <p>&copy; 2025-2026 LeafConection. Todos los derechos reservados.</p>
        </footer>

        <script src="./javaScript/menuDashboardUsuario.js"></script>
    </body>
</html>