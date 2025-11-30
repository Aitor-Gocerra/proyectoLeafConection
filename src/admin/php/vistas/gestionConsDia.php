<!DOCTYPE html>
<html lang="es">

<head>
    <?php
            require_once 'parciales/head.php';
            encabezado("Gestion de Consejos del Día - LeafConnect");
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
            <a href="gestionConsDia.php">GESTIONAR CONSEJOS</a>
            <a href="gestionarUsuarios.php">GESTIONAR USUARIOS</a>
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
        <div id="contenedor">
            <h1>Editar/Eliminar consejos del día</h1>
            <form action="">
                <label for="">Consejo del día</label>
                <textarea name="" id="textoArea" placeholder="Introduce un nuevo consejo"></textarea>

                <label for="">Temática</label>
                <select name="">
                    <option value="">Elige un tema</option>
                    <option value="Salud mental">Salud mental</option>
                    <option value="Sostenibilidad">Desarrollo sostenible</option>
                </select>
                <label for="">Fecha:</label>
                <input type="date" placeholder="dd/mm/yy" id="fecha">
                <div id="contBotones">
                    <input id="botonGuardar" type="submit" value="Guardar consejo">
                    <input id="botonCancelar" type="submit" value="Cancelar">
                </div>

            </form>

        </div>

    </main>

    <footer>
        <?php
            require_once 'parciales/footer.php';
        ?>
    </footer>

    <script src="menuDesplegable.js"></script>

</body>

</html>