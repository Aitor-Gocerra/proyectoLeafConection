<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Gestion de Palabras - LeafConnect");
    ?>
</head>

<body>
    <header>
        <?php
        require_once 'parciales/nav.php';
        ?>
    </header>
    <main>
        <?php
        require_once 'parciales/navegador.php';
        ?>

        <?php
        require_once 'parciales/buscador.php';
        titulo("Palabra");
        ?>


        <div id="contenedorAdmin">
            <h1>Añadir/Editar Palabra del Dia</h1>
            <form action="index.php?c=Palabra&m=guardarNuevaPalabra" method="post">
                <label for="palabra">Palabra</label>
                <input type="text" name="palabra" id="palabra" placeholder="Ej: Arból...">
                <p>Añade una palabra para que sea adivinada.</p>

                <label for="palabraCorrecta">Definición</label>
                <input type="text" name="palabraCorrecta" id="palabraCorrecta"
                    placeholder="Ej: Planta de tallo leñoso y elevado, que se ramifica a cierta altura del suelo.">

                <label for="fecha">Fecha programada</label>
                <input type="date" name="fecha" id="fecha">

                <button type="button" id="añadirPregunta">
                    <i class="fa-regular fa-square-plus"></i> Añadir Pregunta
                </button>

                <div id="cuestionarioContainer">
                    <div class="cuestionarioPregunta">
                        <label>Pista</label>
                        <input type="text" name="pista[]" placeholder="Pista...">
                    </div>
                </div>

                <input type="submit" value="Guardar Palabra">
            </form>

            <?php if (isset($mensaje) && !empty($mensaje)): ?>
                <div class="mensaje">
                    <p><?= $mensaje ?></p>
                </div>
            <?php endif; ?>

            <div id="ultimasDiezPalabras">
                <h2>Últimas 10 Palabras</h2>
                <?php if (isset($palabras) && !empty($palabras)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Palabra</th>
                                <th>Palabra Correcta</th>
                                <th>Fecha Programada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($palabras as $palabra): ?>
                                <tr>
                                    <td><?= $palabra['idPalabra'] ?></td>
                                    <td><?= $palabra['palabra'] ?></td>
                                    <td><?= $palabra['palabraCorrecta'] ?></td>
                                    <td><?= $palabra['fechaProgramada'] ?? 'No programada' ?></td>
                                    <td>
                                        <a href="index.php?c=Palabra&m=eliminarPalabra&idPalabra=<?= $palabra['idPalabra'] ?>"
                                            onclick="return confirm('¿Eliminar esta palabra?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay palabras guardadas aún.</p>
                <?php endif; ?>
            </div>

        </div>
    </main>
    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>

    <script src="../../javascript/anadirPregunta.js"></script>
</body>

</html>