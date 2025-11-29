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
            <div id="navegador">
                <a href="gestionarPalabras.php">GESTIONAR PALABRAS</a>
                <a href="gestionarFrases.php">GESTIONAR FRASES</a>
                <a href="gestionarNoticias.php">GESTIONAR NOTICIAS</a>
                <a href="gestionarConsejos.php">GESTIONAR CONSEJOS</a>
                <a href="gestionarUsuarios.php">GESTIONAR USUARIOS</a>
            </div>
            <div id="contenedorModificarPalabra">
                <h1>Añadir/Editar Palabra del Dia</h1>
                <form action="" method="get">
                    <label for="palabra">Palabra</label>
                    <input type="text" name="palabra" id="palabra" placeholder="Ej: Arból...">
                    <p>Añade una palabra para que sea adivinada.</p>

                    <label for="definicion">Definición</label>
                    <input type="text" name="" id="definicion" placeholder="Ej: Planta de tallo leñoso y elevado, que se ramifica a cierta altura del suelo.">

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <input type="submit" value="Guardar Palabra">
                </form>
            </div>
        </main>
        

        <footer>
            <p>&copy; 2025-2026 ReciQuiz. Todos los derechos reservados.</p>
        </footer>
    </body>
</html>