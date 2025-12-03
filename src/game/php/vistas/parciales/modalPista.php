<?php
echo '
        <div id="modalPista" class="modal">
            <div class="modal-contenido">
                <span class="cerrar-modal">x</span>
                <h3><i class="fas fa-lightbulb"></i> Pista Extra</h3>
                <p>' . (isset($pista['pista']) ? $pista['pista'] : 'No hay pista disponible.') . '</p>
            </div>
        </div>
    ';
?>