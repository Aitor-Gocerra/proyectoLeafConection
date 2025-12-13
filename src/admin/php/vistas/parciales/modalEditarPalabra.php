<?php
if (isset($palabraEditar) && $palabraEditar) {
?>
    <div id="modalEditar" class="modal" style="display: block;">
        <div class="contenedor-modal">
            <span class="cerrar-modal">&times;</span>
            <h1>Editar Palabra</h1>
            <form action="index.php?c=Palabra&m=actualizarPalabra" method="post">
                <input type="hidden" name="idPalabra" value="<?php echo $palabraEditar['idPalabra']; ?>">
                
                <label for="palabraEditar">Palabra</label>
                <input type="text" name="palabra" id="palabraEditar" value="<?php echo $palabraEditar['palabra']; ?>">
                
                <label for="definicionEditar">Definición</label>
                <input type="text" name="definicion" id="definicionEditar" value="<?php echo $palabraEditar['definicion']; ?>">

                <label for="fechaEditar">Fecha programada</label>
                <input type="date" name="fecha" id="fechaEditar" value="<?php echo $palabraEditar['fechaProgramada']; ?>">

                <div class="mensaje-aviso">
                    <p>Nota: Las pistas no se pueden editar desde este formulario rápido.</p>
                </div>

                <input type="submit" value="Actualizar Palabra">
            </form>
        </div>
    </div>
<?php
}
?>