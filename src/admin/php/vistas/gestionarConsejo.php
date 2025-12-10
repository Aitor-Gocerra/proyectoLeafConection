<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        require_once 'parciales/head.php';
        encabezado("Gestion de Consejos del Día - LeafConnect");
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
            titulo("Consejo");
        ?>
        <div id="contenedorAdmin">
            <h1>Editar/Eliminar consejos del día</h1>
            <form action="./index.php?c=Consejo&m=guardarConsejo" method="post">
                <label for="textoArea">Consejo del día</label>
                <textarea name="consejo" id="textoArea" placeholder="Introduce un nuevo consejo" required></textarea> <label for="tematica">Temática</label>
                <select name="idTematicaConsejo" id="tematica"> <option value="">-- Seleccione una opción --</option>
                    
                    <?php foreach ($tematicas as $tematica) { ?>
                            <option value="<?php echo $tematica['idTematica']; ?>">
                                <?php echo $tematica['nombreTematica']; ?> 
                            </option>
                    <?php } ?>
                </select>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fechaProgramada" placeholder="dd/mm/yy" id="fecha"> 

                <div id="contBotones">
                    <input id="botonGuardar" type="submit" value="Guardar consejo">
                </div>
            </form>
        </div>
    </main>

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
                            echo "<a href='index.php?c=Frase&m=editarFrase&idFrase=" . $frase['idFrase'] . "' onclick=\"return confirm('¿Editar esta frase?')\" style='color:orange'>Editar</a>";
                            echo "<br>";
                            echo "<a href='index.php?c=Frase&m=eliminarFrase&idFrase=" . $frase['idFrase'] . "' onclick=\"return confirm('¿Eliminar esta frase?')\" style='color:red'>Eliminar</a>";
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
    <footer>
        <?php
            require_once 'parciales/footer.php';
        ?>
    </footer>
</body>

</html>