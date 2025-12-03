<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestión de Noticia - LeafConnect");
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
                titulo("Noticia");
            ?>

            <?php if (isset($resultadosBusqueda) && !empty($resultadosBusqueda)) { ?>
                <div id="resultadosBusqueda">
                    <h2>Resultados de la Búsqueda</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Fecha Programada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($resultadosBusqueda as $noticia) {
                                echo "<tr>";
                                echo "<td>" . $noticia['idNoticia'] . "</td>";
                                echo "<td>" . $noticia['titulo'] . "</td>";
                                echo "<td>" . ($noticia['fechaProgramada'] ?? 'No programada') . "</td>";
                                echo "<td>";
                                echo "<a href='index.php?c=GestionarNoticias&m=eliminar&idNoticia=" . $noticia['idNoticia'] . "' onclick=\"return confirm('¿Eliminar esta noticia?')\">Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } elseif (isset($_GET['buscar'])) { ?>
                <div class="mensaje">
                    <p>No se encontraron noticias con el término: <?php echo $_GET['buscar']; ?></p>
                </div>
            <?php } ?>

            <div id="contenedorAdmin">
                <h1>Gestión de noticias</h1>
                <form action="" method="post" id="noticia_formulario">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ej: Greta Thunberg">

                    <label for="contenido">Contenido</label>
                    <textarea name="contenido" id="contenido" rows="5" placeholder="Escribe el contenido de la noticia"></textarea>

                    <label for="url">URL de la imagen</label>
                    <input type="text" name="url" id="url" placeholder="Ej: https://...">

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <label>Cuestionario</label>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pregunta</label>
                            <input type="text" name="pregunta[]" placeholder="Escribe la pregunta">

                            <label>Opciones (separadas por '/')</label>
                            <input type="text" name="opciones[]" class="opciones" placeholder="Opción1/Opción2/Opción3">

                            <label>Respuesta correcta</label>
                            <input type="number" name="respuesta_correcta[]" min="1" placeholder="Número de la respuesta correcta">
                        </div>
                    </div>

                    <input type="submit" value="Guardar noticia">
                </form>

                <button type="button" id="añadirPregunta">
                    <i class="fa-regular fa-square-plus"></i> Añadir Pregunta
                </button>
            </div>
        </main>

        <!-- Resultados de búsqueda -->
        
        <div id="ultimasDiezFrases">
            <h2>Últimas 10 Frases</h2>
            <?php if (isset($noticias) && !empty($noticias)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Noticia</th>
                            <th>Fecha Programada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($noticias as $noticia) {
                            echo "<tr>";
                            echo "<td>" . $noticia['idNoticia'] . "</td>";
                            echo "<td>" . $noticia['titulo'] . "</td>";
                            echo "<td>" . ($noticia['fechaProgramada'] ?? 'No programada') . "</td>";
                            echo "<td>";
                            echo "<a href='index.php?c=GestionarNoticias&m=eliminar&idNoticia=" . $noticia['idNoticia'] . "' onclick=\"return confirm('¿Eliminar esta noticia?')\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay noticias guardadas aún.</p>
            <?php } ?>
        </div>

        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>


        <script>
            // Script para el buscador de noticias
            document.getElementById('formBuscar').addEventListener('submit', function (e) {
                e.preventDefault();
                const buscar = document.getElementById('inputBuscar').value.trim();
                if (buscar !== '') {
                    window.location.href = 'index.php?c=GestionarNoticias&m=buscarNoticias&buscar=' + encodeURIComponent(buscar);
                }
            });

            // Mostrar alert si hay mensaje de éxito o error
            const urlParams = new URLSearchParams(window.location.search);
            const successMessage = urlParams.get('success');
            const errorMessage = urlParams.get('error');

            if (successMessage) {
                alert(successMessage);
                // Limpiar el parámetro de la URL sin recargar la página
                window.history.replaceState({}, document.title, 'index.php?c=GestionarNoticias&m=buscarNoticias');
            }

            if (errorMessage) {
                alert('Error: ' + errorMessage);
                window.history.replaceState({}, document.title, 'index.php?c=GestionarNoticias&m=buscarNoticias');
            }
        </script>

        
        <script>
            let btnAñadirPregunta = document.getElementById("añadirPregunta");
            let plantilla = document.querySelector(".cuestionarioPregunta"); // primera pregunta
            let contenedor = document.getElementById("cuestionarioContainer");

            btnAñadirPregunta.addEventListener("click", function(e) {
                e.preventDefault();

                // Clonar la plantilla
                let nuevaPregunta = document.createElement("div");
                nuevaPregunta.classList.add("cuestionarioPregunta");
                nuevaPregunta.innerHTML = plantilla.innerHTML;

                // Limpiar valores de los inputs
                let inputs = nuevaPregunta.querySelectorAll('input');
                inputs.forEach(input => input.value = '');

                // Añadir al contenedor de preguntas
                contenedor.appendChild(nuevaPregunta);
            });
        </script>
    </body>
</html>
