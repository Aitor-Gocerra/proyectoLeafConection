<?php
echo '
        <nav>
            <div class="infoJuego">
                <img src="./imagenes/logo.jpg" alt="logo Juego" class="logo">
                <h3>LeafConection</h3>
            </div>

            <div class="perfil">
                <img src="./imagenes/fotoPerfil.jpg" alt="Foto de perfil" id="fotoPerfil">

                <div id="menuDesplegable">
                    <a href="index.php?c=Paginas&m=gestionAmigos"><i class="fas fa-users"></i> Mis Amigos</a>
                    <a href="index.php?c=Paginas&m=estadisticas"><i class="fas fa-chart-bar"></i> Mis Estadísticas</a>
                    <a href="#cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </div>
            </div>
        </nav>
        ';

echo "
        <script>
            const fotoPerfil = document.getElementById('fotoPerfil');
            const menuDesplegable = document.getElementById('menuDesplegable');

            fotoPerfil.addEventListener('click', function() {
                if (menuDesplegable.style.display === 'block') {
                    menuDesplegable.style.display = 'none';
                } else {
                    menuDesplegable.style.display = 'block';
                }
            });

            // Cerrar el menú al hacer clic fuera
            window.addEventListener('click', function(event) {
                if (event.target.id !== 'fotoPerfil' && !menuDesplegable.contains(event.target)) {
                    menuDesplegable.style.display = 'none';
                }
            });
        </script>";
?>