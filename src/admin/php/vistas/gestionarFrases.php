<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    require_once 'parciales/head.php';
    encabezado("Gestion de Frase - LeafConnect");
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
        titulo("Frase");
        ?>
        <div id="contenedorAdmin">
            <h1>Añadir/Editar Frase del Dia</h1>
            <form action="index.php?c=Frase&m=guardarNuevaFrase" method="post">
                <label for="frase">Frase</label>
                <input type="text" name="frase" id="frase"
                    placeholder="Ej: La Tierra no es una herencia de nuestros padres, sino un prestamo de nuestros _____.">
                <p>Usa '___' para el lugar donde ira la palabra que falta</p>

                <label for="palabraFaltante">Palabra que falta</label>
                <input type="text" name="palabraFaltante" id="palabraFaltante" placeholder="Ej: hijos">

                <label for="autor">Autor</label>
                <input type="text" name="autor" id="autor" placeholder="Ej: Provervio nativo americano">

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

                <input type="submit" value="Guardar Frase">
            </form>


        </div>

        <?php if (isset($mensaje) && !empty($mensaje)) { ?>
            <div class="mensaje">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php } ?>

        <div id="ultimasDiezFrases">
            <h2>Últimas 10 Frases</h2>
            <?php if (isset($frases) && !empty($frases)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Frase</th>
                            <th>Palabra Faltante</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($frases as $frase) {
                            echo "<tr>";
                            echo "<td>" . $frase['idFrase'] . "</td>";
                            echo "<td>" . $frase['frase'] . "</td>";
                            echo "<td>" . $frase['palabraFaltante'] . "</td>";
                            echo "<td>" . ($frase['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=Frase&m=eliminarFrase&idFrase=" . $frase['idFrase'] . "' onclick=\"return confirm('¿Eliminar esta frase?')\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay frases guardadas aún.</p>
            <?php } ?>
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