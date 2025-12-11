<?php
if (isset($fraseEditar) && $fraseEditar) {
    ?>
    <div id="modalEditar" class="modal" style="display: block;">
        <div class="contenedor-modal">
            <span class="cerrar-modal">&times;</span>
            <h1>Editar Frase</h1>
            <form action="index.php?c=Frase&m=actualizarFrase" method="post">
                <input type="hidden" name="idFrase" value="<?php echo $fraseEditar['idFrase']; ?>">

                <label for="fraseEditar">Frase</label>
                <input type="text" name="frase" id="fraseEditar" value="<?php echo $fraseEditar['frase']; ?>">

                <label for="palabraFaltanteEditar">Palabra que falta</label>
                <input type="text" name="palabraFaltante" id="palabraFaltanteEditar"
                    value="<?php echo $fraseEditar['palabraFaltante']; ?>">

                <label for="fechaEditar">Fecha programada</label>
                <input type="date" name="fecha" id="fechaEditar" value="<?php echo $fraseEditar['fechaProgramada']; ?>">

                <div class="mensaje-aviso">
                    <p>Nota: Las pistas no se pueden editar desde este formulario rápido.</p>
                </div>

                <input type="submit" value="Actualizar Frase">
            </form>
        </div>
    </div>
    <?php
}
?>


