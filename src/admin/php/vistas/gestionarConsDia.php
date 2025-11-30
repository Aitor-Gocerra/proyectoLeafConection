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
        <?php
             require_once 'parciales/navegador.php';
         ?>

        <?php
            require_once 'parciales/buscador.php';
            titulo("Consejo");
        ?>
        <div id="contenedorAdmin">
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
</body>

</html>