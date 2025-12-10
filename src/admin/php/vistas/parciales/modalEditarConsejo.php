<?php
if (isset($consejoEditar) && $consejoEditar) {
    $tematicas = $tematicas ?? [];
    $idTematicaActual = $consejoEditar['idTematica'] ?? null;
    ?>
    <div id="modalEditar" class="modal" style="display: block;">
        <div class="contenedor-modal">
            <span class="cerrar-modal">&times;</span>
            <h1>Editar Consejo</h1>
            <form action="index.php?c=Consejo&m=actualizarConsejo" method="post">
                <input type="hidden" name="idConsejoEdicion" value="<?php echo $consejoEditar['idConsejo']; ?>">

                <label for="consejoEditar">Consejo</label>
                <input type="text" name="consejo" id="consejoEditar" value="<?php echo htmlspecialchars($consejoEditar['consejo'], ENT_QUOTES); ?>">

                <label for="tematicaEditar">Temática</label>
                <select name="idTematicaConsejo" id="tematicaEditar">
                    <option value="">-- Seleccione una opción --</option>
                    <?php foreach ($tematicas as $t) {
                        $id = $t['idTematica'];
                        $nombre = $t['nombreTematica'];
                        $selected = ($id == $idTematicaActual) ? 'selected' : '';
                    ?>
                        <option value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="fechaEditar">Fecha programada</label>
                <input type="date" name="fechaProgramada" id="fechaEditar" value="<?php echo htmlspecialchars($consejoEditar['fechaProgramada'] ?? '', ENT_QUOTES); ?>">

                <div class="mensaje-aviso">
                    <p>Nota: edición rápida.</p>
                </div>

                <input type="submit" value="Actualizar Consejo">
            </form>
        </div>
    </div>
    <?php
}
?>
