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
            <search id="buscadorFrases">
                <h2>Buscar Frase a Modificar</h2>
                <form action="#" method="get">
                    <input type="search" id="inputBuscar" name="query" placeholder="Introduce una palabra clave o parte de la frase..." aria-label="Buscar frase a modificar">
                    <button type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>
            </search>
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