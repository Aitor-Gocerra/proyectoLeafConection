<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Gestion de Consejos - LeafConnect");
    ?>
</head>

<body>
    <header>
        <?php require_once 'parciales/nav.php'; ?>
    </header>

    <main>
        <?php require_once 'parciales/navegador.php'; ?>

        <?php
        require_once 'parciales/buscador.php';
        titulo("Consejo");
        ?>

        <!-- Resultados de búsqueda -->
        <?php if (isset($resultadosBusqueda) && !empty($resultadosBusqueda)) { ?>
            <div id="resultadosBusqueda">
                <h2>Resultados de la Búsqueda</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Consejo</th>
                            <th>Temática</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultadosBusqueda as $c) {
                            echo "<tr>";
                            echo "<td>" . $c['idConsejo'] . "</td>";
                            echo "<td>" . $c['consejo'] . "</td>";
                            echo "<td>" . ($c['nombreTematica'] ?? '—') . "</td>";
                            echo "<td>" . ($c['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=mConsejo&m=editarConsejo&idConsejo=" . $c['idConsejo'] . "&modal=1' onclick=\"return confirm('¿Editar este consejo?')\" style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=mConsejo&m=eliminarConsejo&idConsejo=" . $c['idConsejo'] . "' onclick=\"return confirm('¿Eliminar este consejo?')\" style='color:red'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } elseif (isset($_GET['buscar'])) { ?>
            <div class="mensaje">
                <p>No se encontraron consejos con el término: <?php echo htmlspecialchars($_GET['buscar'], ENT_QUOTES); ?></p>
            </div>
        <?php } ?>

        <div id="contenedorAdmin">
            <div class="encabezado-seccion">
                <h1>Añadir/Editar Consejo del Día</h1>
                <a href="#ultimosDiezConsejos" class="enlace-listado">Ir al listado de consejos <i class="fa-solid fa-arrow-down"></i></a>
            </div>

            <form action="<?php echo (isset($consejoEditar) && !$usarModal) ? 'index.php?c=cGestionarConsejo&m=actualizarConsejo' : 'index.php?c=Consejo&m=guardarNuevaConsejo'; ?>" method="post">
                <?php if (isset($consejoEditar) && !$usarModal) { ?>
                    <input type="hidden" name="idConsejoEdicion" value="<?php echo $consejoEditar['idConsejo']; ?>">
                <?php } ?>

                <label for="consejo">Consejo</label>
                <input type="text" name="consejo" id="consejo" placeholder="Escribe aquí el consejo" value="<?php echo (isset($consejoEditar) && !$usarModal) ? htmlspecialchars($consejoEditar['consejo'], ENT_QUOTES) : ''; ?>" required>

                <label for="idTematicaConsejo">Temática</label>
                <select name="idTematicaConsejo" id="idTematicaConsejo" required>
                    <option value="">-- Seleccione una opción --</option>
                    <?php
                    // Cargar temáticas si vienen  o pedir al modelo si no están
                    if (!isset($tematicas) || $tematicas === null) {
                        // intentar cargar desde el modelo si no existe 
                        require_once __DIR__ . '/../modelos/mConsejo.php';
                        $m = new Consejo();
                        $tematicas = $m->listarTematicas();
                    }
                    if (!empty($tematicas)) {
                        foreach ($tematicas as $t) {
                            $selId = $t['idTematica'];
                            $selNombre = $t['nombreTematica'];
                            $selected = (isset($consejoEditar) && $consejoEditar['idTematica'] == $selId && !$usarModal) ? 'selected' : '';
                            echo "<option value=\"" . htmlspecialchars($selId, ENT_QUOTES) . "\" $selected>" . htmlspecialchars($selNombre, ENT_QUOTES) . "</option>";
                        }
                    }
                    ?>
                </select>

                <label for="fechaProgramada">Fecha programada</label>
                <input type="date" name="fechaProgramada" id="fechaProgramada" value="<?php echo (isset($consejoEditar) && !$usarModal) ? htmlspecialchars($consejoEditar['fechaProgramada'] ?? '', ENT_QUOTES) : ''; ?>">

                <div class="grupo-acciones">
                    <input type="submit" value="<?php echo (isset($consejoEditar) && !$usarModal) ? 'Actualizar Consejo' : 'Guardar Consejo'; ?>">

                    <?php if (isset($consejoEditar) && !$usarModal) { ?>
                        <button type="button" class="btn-secundario" onclick="window.location.href='index.php?c=Consejo&m=gestionarConsejo'">
                            <i class="fa-solid fa-times"></i>&nbsp;Cancelar
                        </button>
                    <?php } else { ?>
                        <button type="button" class="btn-secundario" onclick="if(confirm('Vas a poner a NULL todas las fechas antiguas. ¿Estás seguro?')) { window.location.href='index.php?c=Consejo&m=actualizarFechas'; }">
                            <i class="fa-solid fa-arrows-rotate"></i>&nbsp;Fechas
                        </button>
                    <?php } ?>
                </div>
            </form>

            <?php if (isset($mensaje) && !empty($mensaje)) { ?>
                <div class="mensaje">
                    <p><?php echo $mensaje; ?></p>
                </div>
            <?php } ?>
        </div>

        <br>

        <div id="ultimosDiezConsejos">
            <h2>Últimos 10 Consejos</h2>
            <?php if (isset($consejos) && !empty($consejos)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Consejo</th>
                            <th>idTemática</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($consejos as $consejo) {
                            echo "<tr>";
                            echo "<td>" . $consejo['idConsejo'] . "</td>";
                            echo "<td>" . $consejo['consejo'] . "</td>";
                            echo "<td>" . $consejo['nombreTematica'] . "</td>";
                            echo "<td>" . ($consejo['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Consejo&m=editarConsejo&idConsejo=" . $consejo['idConsejo'] . "&modal=1' onclick=\"return confirm('¿Editar este consejo?')\" style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Consejo&m=eliminarConsejo&idConsejo=" . $consejo['idConsejo'] . "' onclick=\"return confirm('¿Eliminar este consejo?')\" style='color:red'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay consejos guardados aún.</p>
            <?php } ?>
        </div>

        <?php
        if (isset($usarModal) && $usarModal) {
            require_once 'parciales/editarConsejo.php';
        }

        require_once 'parciales/notificacion.php';
        ?>

    </main>

    <footer>
        <?php require_once 'parciales/footer.php'; ?>
    </footer>

    <script>
        // Script para el buscador (si tienes formBuscar en parciales/buscador.php)
        const formBuscar = document.getElementById('formBuscar');
        if (formBuscar) {
            formBuscar.addEventListener('submit', function (e) {
                e.preventDefault();
                const buscarInput = document.getElementById('inputBuscar');
                if (buscarInput && buscarInput.value.trim() !== '') {
                    window.location.href = 'index.php?c=mConsejo&m=buscarConsejos&buscar=' + encodeURIComponent(buscarInput.value.trim());
                }
            });
        }

        // Modal close handling (si el modal está presente)
        const modal = document.getElementById("modalEditar");
        const span = document.getElementsByClassName("cerrar-modal")[0];

        if (modal && span) {
            span.onclick = function () {
                modal.style.display = "none";
                window.history.replaceState({}, document.title, 'index.php?c=mConsejo&m=gestionarConsejo');
            }
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.history.replaceState({}, document.title, 'index.php?c=mConsejo&m=gestionarConsejo');
                }
            }
        }

        // Notificación breve si $mensaje está presente
        const mensaje = "<?php echo isset($mensaje) ? addslashes($mensaje) : ''; ?>";
        const notificacion = document.getElementById("notificacion");
        if (mensaje !== "") {
            if (notificacion) {
                notificacion.textContent = mensaje;
                notificacion.style.opacity = "1";
                setTimeout(() => { notificacion.style.opacity = "0"; }, 3000);
            } else {
                alert(mensaje);
            }
        }
    </script>
</body>

</html>
