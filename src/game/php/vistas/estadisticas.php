<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ESTADISTICAS</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="infoJuego">
                    <img src="./imagenes/logo.png" alt="logo Empresa" class="logo">
                    <h3>LeafConection</h3>
                </div>

                <div class="perfil">
                    <img src="./imagenes/fotoPerfil.jpg" alt="Foto de perfil" id="fotoPerfil">

                    <div id="menuDesplegable">
                        <a href="#amigos"><i class="fas fa-users"></i> Mis Amigos</a>
                        <a href="#estadisticas"><i class="fas fa-chart-bar"></i> Mis Estadísticas</a>
                        <a href="#cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <h2 id="tituloEstadisticas">TUS ESTADISTICAS</h2>
            <div id="tablaEstadisticas">
                <div class="tarjetaEstadisticas">
                    <p>Partidas jugadas</p>
                    <i class="fas fa-gamepad"></i>
                    <h3>40</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Partidas completadas</p>
                    <i class="fas fa-flag-checkered"></i>
                    <h3>38</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Tasa de finalizacion</p>
                    <i class="fas fa-chart-line"></i>
                    <h3>70%</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Tiempo promedio</p>
                    <i class="fas fa-clock"></i>
                    <h3>40</h3>
                </div>
            </div>
            <div id="graficoEstadisticas">
                <h2>Progreso semanal</h2>
                <p>Numero de partidas jugadas esta semana</p>
                <img src="./imagenes/grafico.png" alt="grafico de jugadas">
            </div>
        </main>

        <a href="inicio.php" id="enlaceVolver">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        <footer>
            <p>&copy; 2025-2026 LeafConection. Todos los derechos reservados.</p>
        </footer>

        <script src="./javaScript/menuDashboardUsuario.js"></script>
    </body>
</html>