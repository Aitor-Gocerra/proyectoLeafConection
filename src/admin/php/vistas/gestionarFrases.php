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
            <h1>Añadir Frase del Dia</h1>
            <form action="index.php?c=Frase&m=guardarNuevaFrase" method="post">
                <label for="frase">Frase</label>
                <input type="text" name="frase" id="frase"
                    placeholder="Ej: La Tierra no es una herencia de nuestros padres, sino un prestamo de nuestros _____.">
                <p>Usa '___' para el lugar donde ira la palabra que falta</p>

                <label for="palabraFaltante">Palabra que falta</label>
                <input type="text" name="palabraFaltante" id="palabraFaltante" placeholder="Ej: hijos">

                <label for="fecha">Fecha programada</label>
                <input type="date" name="fecha" id="fecha">

                <button type="button" id="btnAnadirPregunta">
                    <i class="fa-regular fa-square-plus"></i> Añadir Pista
                </button>

                <div id="cuestionarioContainer">
                    <div class="cuestionarioPregunta">
                        <label>Pista</label>
                        <input type="text" name="pista[]" placeholder="Pista..." required>
                    </div>
                </div>

                <input type="submit" value="Guardar Frase">
            </form>


        </div>

        <?php if (isset($mensaje) && !empty($mensaje)) { ?>
            <div class="mensaje">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php } ?>

        <!-- Resultados de búsqueda -->
        <?php if (isset($resultadosBusqueda) && !empty($resultadosBusqueda)) { ?>
            <div id="resultadosBusqueda">
                <h2>Resultados de la Búsqueda</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Frase</th>
                            <th>Palabra Faltante</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultadosBusqueda as $frase) {
                            echo "<tr>";
                            echo "<td>" . $frase['idFrase'] . "</td>";
                            echo "<td>" . $frase['frase'] . "</td>";
                            echo "<td>" . $frase['palabraFaltante'] . "</td>";
                            echo "<td>" . ($frase['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Frase&m=editarFrase&idFrase=" . $frase['idFrase'] . "'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Frase&m=eliminarFrase&idFrase=" . $frase['idFrase'] . "' onclick=\"return confirm('¿Eliminar esta frase?')\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } elseif (isset($_GET['buscar'])) { ?>
            <div class="mensaje">
                <p>No se encontraron frases con el término: <?php echo $_GET['buscar']; ?></p>
            </div>
        <?php } ?>

        <br>
        <div id="ultimasDiezFrases">
            <h2>Últimas 10 Frases</h2>
            <?php if (isset($frases) && !empty($frases)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Frase</th>
                            <th>Palabra Faltante</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($frases as $frase) {
                            echo "<tr>";
                            echo "<td>" . $frase['idFrase'] . "</td>";
                            echo "<td>" . $frase['frase'] . "</td>";
                            echo "<td>" . $frase['palabraFaltante'] . "</td>";
                            echo "<td>" . ($frase['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Frase&m=editarFrase&idFrase=" . $frase['idFrase'] . " onclick=\"return confirm('¿Editar esta frase?')\" style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Frase&m=eliminarFrase&idFrase=" . $frase['idFrase'] . "' onclick=\"return confirm('¿Eliminar esta frase?')\" style='color:red'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay frases guardadas aún.</p>
            <?php } ?>
        </div>

        <?php
        require_once 'parciales/modalEditarFrase.php';
        ?>

    </main>
    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>

    <script src="javascript/anadirPregunta.js"></script>
    <script>
        // Script para el buscador de frases
        document.getElementById('formBuscar').addEventListener('submit', function (e) {
            e.preventDefault();
            const buscar = document.getElementById('inputBuscar').value;
            if (buscar.trim() !== '') {
                window.location.href = 'index.php?c=Frase&m=buscarFrases&buscar=' + buscar;
            }
        });

        // Mostrar alert si hay mensaje de éxito o error
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get('success');
        const errorMessage = urlParams.get('error');

        if (successMessage) {
            alert(successMessage);
            // Limpiar el parámetro de la URL sin recargar la página
            window.history.replaceState({}, document.title, 'index.php?c=Frase&m=gestionarFrases');
        }

        if (errorMessage) {
            alert('Error: ' + errorMessage);
            window.history.replaceState({}, document.title, 'index.php?c=Frase&m=gestionarFrases');
        }
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
                window.history.replaceState({}, document.title, 'index.php?c=Frase&m=gestionarFrases');
            }

            // Cuando el usuario hace clic fuera del modal, también se cierra
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.history.replaceState({}, document.title, 'index.php?c=Frase&m=gestionarFrases');
                }
            }
        }
    </script>
</body>

</html>