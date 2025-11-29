<!DOCTYPE html>
<html lang="es">

    <head>
        <?php
        require_once 'parciales/head.php';
        encabezado("ESTADISTICAS");
        ?>
    </head>

    <body>
        <header>
            <?php
            require_once 'parciales/nav.php';
            ?>
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

        <a href="index.php" id="enlaceVolver">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        <footer>
            <p>&copy; 2025-2026 LeafConection. Todos los derechos reservados.</p>
        </footer>

        <script src="./javaScript/menuDashboardUsuario.js"></script>
        
    </body>

</html>