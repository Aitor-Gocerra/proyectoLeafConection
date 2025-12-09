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

        <!-- Resultados de búsqueda -->
        <?php if (isset($resultadosBusqueda) && !empty($resultadosBusqueda)) { ?>
            <div id="resultadosBusqueda">
                <h2>Resultados de la Búsqueda</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Palabra</th>
                            <th>Definición</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultadosBusqueda as $palabra) {
                            echo "<tr>";
                            echo "<td>" . $palabra['idPalabra'] . "</td>";
                            echo "<td>" . $palabra['palabra'] . "</td>";
                            echo "<td>" . $palabra['definicion'] . "</td>";
                            echo "<td>" . ($palabra['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Palabra&m=editarPalabra&idPalabra=" . $palabra['idPalabra'] . "&modal=1' onclick=\"return confirm('¿Editar esta palabra?')\" style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Palabra&m=eliminarPalabra&idPalabra=" . $palabra['idPalabra'] . "' onclick=\"return confirm('¿Eliminar esta palabra?')\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } elseif (isset($_GET['buscar'])) { ?>
            <div class="mensaje">
                <p>No se encontraron palabras con el término: <?php echo $_GET['buscar']; ?></p>
            </div>
        <?php } ?>

        <div id="contenedorAdmin">
            <h1>Añadir/Editar Palabra del Dia</h1>
            <a href="#ultimasDiezPalabras">Ir al listado de palabras</a>
            <form
                action="<?php echo (isset($palabraEditar) && !$usarModal) ? 'index.php?c=Palabra&m=actualizarPalabra' : 'index.php?c=Palabra&m=guardarNuevaPalabra'; ?>"
                method="post">

                <?php if (isset($palabraEditar) && !$usarModal) { ?>
                    <input type="hidden" name="idPalabra" value="<?php echo $palabraEditar['idPalabra']; ?>">
                <?php } ?>

                <label for="palabra">Palabra</label>
                <input type="text" name="palabra" id="palabra" placeholder="Ej: Arból..."
                    value="<?php echo (isset($palabraEditar) && !$usarModal) ? $palabraEditar['palabra'] : ''; ?>"
                    required>
                <p>Añade una palabra para que sea adivinada.</p>

                <label for="definicion">Definición</label>
                <input type="text" name="definicion" id="definicion"
                    placeholder="Ej: Planta de tallo leñoso y elevado, que se ramifica a cierta altura del suelo."
                    value="<?php echo (isset($palabraEditar) && !$usarModal) ? $palabraEditar['definicion'] : ''; ?>"
                    required>

                <label for="fecha">Fecha programada</label>
                <input type="date" name="fecha" id="fecha"
                    value="<?php echo (isset($palabraEditar) && !$usarModal) ? $palabraEditar['fechaProgramada'] : ''; ?>">

                <?php if (!isset($palabraEditar) || $usarModal) { ?>
                    <button type="button" id="btnAnadirPregunta">
                        <i class="fa-regular fa-square-plus"></i> Añadir Pista
                    </button>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pista</label>
                            <input type="text" name="pista[]" placeholder="Pista..." required>
                        </div>
                    </div>
                <?php } ?>

                <div class="grupo-acciones">
                    <input type="submit"
                        value="<?php echo (isset($palabraEditar) && !$usarModal) ? 'Actualizar Palabra' : 'Guardar Palabra'; ?>">

                    <?php if (isset($palabraEditar) && !$usarModal) { ?>
                        <button type="button" class="btn-secundario"
                            onclick="window.location.href='index.php?c=Palabra&m=gestionarPalabras'">
                            <i class="fa-solid fa-times"></i>&nbsp;Cancelar
                        </button>
                    <?php } else { ?>
                        <button type="button" class="btn-secundario" onclick="
                                        if(confirm('Vas a poner a NULL todas las fechas antiguas. ¿Estás seguro?')) { 
                                            window.location.href='index.php?c=Palabra&m=actualizarFechas'; 
                                        }">
                            <i class="fa-solid fa-arrows-rotate"></i>&nbsp;Fechas
                        </button>
                    <?php } ?>
                </div>
            </form>
        </div>

        <br>
        
        <div id="ultimasDiezPalabras">
            <h2>Últimas 10 Palabras</h2>
            <?php if (isset($palabras) && !empty($palabras)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Palabra</th>
                            <th>Definición</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($palabras as $palabra) {
                            echo "<tr>";
                            echo "<td>" . $palabra['idPalabra'] . "</td>";
                            echo "<td>" . $palabra['palabra'] . "</td>";
                            echo "<td>" . $palabra['definicion'] . "</td>";
                            echo "<td>" . ($palabra['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Palabra&m=editarPalabra&idPalabra=" . $palabra['idPalabra'] . "' style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Palabra&m=eliminarPalabra&idPalabra=" . $palabra['idPalabra'] . "' onclick=\"return confirm('¿Eliminar esta palabra?')\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay palabras guardadas aún.</p>
            <?php } ?>
        </div>

        <?php
        if (isset($usarModal) && $usarModal) {
            require_once 'parciales/modalEditarPalabra.php';
        }
        ?>

        <?php
        require_once 'parciales/notificacion.php';
        ?>

    </main>
    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>

    <script src="javascript/anadirPregunta.js"></script>

    <script>
        // Script para el buscador de palabras
        document.getElementById('formBuscar').addEventListener('submit', function (e) {
            e.preventDefault();
            const buscar = document.getElementById('inputBuscar').value;
            if (buscar.trim() !== '') {
                window.location.href = 'index.php?c=Palabra&m=buscarPalabras&buscar=' + buscar;
            }
        });

        // Mostrar alert si hay mensaje de éxito o error
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get('success');
        const errorMessage = urlParams.get('error');

        if (successMessage) {
            alert(successMessage);
            // Limpiar el parámetro de la URL sin recargar la página
            window.history.replaceState({}, document.title, 'index.php?c=Palabra&m=gestionarPalabras');
        }

        if (errorMessage) {
            alert('Error: ' + errorMessage);
            window.history.replaceState({}, document.title, 'index.php?c=Palabra&m=gestionarPalabras');
        }

        /* El formulario NO se envía automáticamente, sino que usa JavaScript para construir la URL
        El JavaScript captura el evento submit del formulario
        Coge el valor del input de búsqueda
        Construye manualmente la URL: index.php?c=Palabra&m=buscarPalabras&buscar=loQueBuscas
        Redirige a esa URL con window.location.href */
    </script>

    <script>
        // Obtener elementos
        const modal = document.getElementById("modalEditar");
        const span = document.getElementsByClassName("cerrar-modal")[0];

        // Si el modal existe (porque PHP lo renderizó), configurar el cierre
        if (modal && span) {
            // Cuando el usuario hace clic en (x), cierra el modal y limpia la URL
            span.onclick = function () {
                modal.style.display = "none";
                // Limpiar la URL para quitar los parámetros de edición
                window.history.replaceState({}, document.title, 'index.php?c=Palabra&m=gestionarPalabras');
            }

            // Cuando el usuario hace clic fuera del modal, también se cierra
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.history.replaceState({}, document.title, 'index.php?c=Palabra&m=gestionarPalabras');
                }
            }
        }
    </script>

    <script>
        const mensaje = "<?php echo $mensaje ?? ''; ?>";

        const notificacion = document.getElementById("notificacion");

        if (mensaje !== "") {
            notificacion.textContent = mensaje;
            notificacion.style.opacity = "1";

            // Ocultar después de 3 segundos
            setTimeout(() => {
                notificacion.style.opacity = "0";
            }, 3000);
        }
    </script>
</body>

</html>