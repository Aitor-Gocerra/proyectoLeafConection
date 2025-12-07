

    <?php foreach ($solicitudes as $amigo): ?>
        
        <div class="item-solicitud">
            
            <img src="<?= !empty($amigo['foto']) ? $amigo['foto'] : './imagenes/fotoPerfil.jpg' ?>" class="fotoAmigo">
            
            <p class="nombreAmigo"><?= htmlspecialchars($amigo['nombre']) ?></p> 

            <button type="button" class="aceptarSolicitud" 
                    onclick="window.controladorAmigos.procesarRespuesta(<?= $amigo['idUsuario'] ?>, 'aceptar')">
                Aceptar <i class="fa-solid fa-user-check"></i>
            </button>

            <button type="button" class="rechazarSolicitud" 
                    onclick="window.controladorAmigos.procesarRespuesta(<?= $amigo['idUsuario'] ?>, 'rechazar')">
                Rechazar <i class="fa-solid fa-user-xmark"></i>
            </button>
            
        </div>

    <?php endforeach; ?>
