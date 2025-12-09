<!DOCTYPE html>
<html lang="es">

    <head>
        <?php
        require_once 'parciales/head.php';
        encabezado("Estadisticas");
        ?>
    </head>

    <body>
        <header>
            <?php require_once 'parciales/nav.php'; ?>
        </header>
        <main>
            <h2 id="tituloEstadisticas">TUS ESTADÍSTICAS</h2>
            <div id="tablaEstadisticas">
                <div class="tarjetaEstadisticas">
                    <p>Partidas jugadas</p>
                    <i class="fas fa-gamepad"></i>
                    <h3>0</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Puntuación total</p>
                    <i class="fas fa-flag-checkered"></i>
                    <h3>0</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Mejor puntuación</p>
                    <i class="fas fa-chart-line"></i>
                    <h3>0</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Tiempo medio por partida</p>
                    <i class="fas fa-clock"></i>
                    <h3>0</h3>
                </div>
                <div class="tarjetaEstadisticas">
                    <p>Racha</p>
                    <i class="fa-solid fa-fire"></i>
                    <h3>0 días</h3>
                </div>
            </div>
            <div id="graficoEstadisticas">
                <h2>Progreso semanal</h2>
                <p>Número de partidas jugadas esta semanaX</p>
                <img src="./imagenes/graficos.jpg" alt="Gráfico de jugadas">
            </div>
        </main>

        <?php require_once 'parciales/botonVolver.php'; ?>
        
        <footer>
            <?php require_once 'parciales/footer.php'; ?>
        </footer>

        <script>
            window.ID_USUARIO = <?php echo $_SESSION['idUsuario'] ?? 'null'; ?>;
        </script>

        <script src="javaScript/modelos/mEstadisticas.js"></script>
        <script src="javaScript/controladores/cEstadisticas.js"></script>
        <script src="javaScript/vistas/vEstadisticas.js"></script>
        <script src="javaScript/app.js"></script>
    </body>

</html>
