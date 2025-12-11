<?php if (isset($consejoEditar) && $consejoEditar) {
    ?>
    <div id="modalEditar" class="modal" style="display: block;">
        <div class="contenedor-modal">
            <span class="cerrar-modal">&times;</span>
            <h1>Editar Consejo</h1>
            <form action="index.php?c=Consejo&m=actualizarConsejo" method="post">
                <input type="hidden" name="idConsejoEdicion" value="<?php echo $consejoEditar['idConsejo']; ?>">

                <label for="consejoEditar">Consejo</label>
                <input type="text" name="consejo" id="consejoEditar" value="<?php echo $consejoEditar['consejo']; ?>">

                <label for="tematicaEditar">Temática</label>
                <select name="idTematicaConsejo" id="tematicaEditar">
                    <option value="">-- Seleccione una opción --</option>
                    <?php foreach ($tematicas as $t) {
                        $id = $t['idTematica'];
                        $nombre = $t['nombreTematica'];
                        $selected = ($id == $idTematicaActual) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $id ?>" <?php echo $selected; ?>>
                            <?php echo $nombre ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="fechaEditar">Fecha programada</label>
                <input type="date" name="fechaProgramada" id="fechaEditar" value="<?php echo $consejoEditar['fechaProgramada'] ; ?>">

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
