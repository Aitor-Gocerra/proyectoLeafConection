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
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($resultadosBusqueda as $noticia) {
                                echo '<tr>' .
                                        '<td>' . $noticia['idNoticia'] . '</td>' .
                                        '<td>' . $noticia['titulo'] . '</td>' .
                                        '<td>' . ($noticia['fechaProgramada'] ?? 'No programada') . '</td>' .
                                        '<td style="text-align: center;"><a href="index.php?c=GestionarNoticias&m=modificar&idNoticia=' . $noticia['idNoticia'] . '"><i class="fa-solid fa-pen-to-square"></i></a></td>' .
                                        '<td style="text-align: center;"><a href="index.php?c=GestionarNoticias&m=eliminar&idNoticia=' . $noticia['idNoticia'] . '" onclick="return confirm(\'¿Eliminar esta noticia?\')"><i class="fa-regular fa-circle-xmark"></i></a></td>' .
                                    '</tr>';
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
                <form action="./index.php?c=GestionarNoticias&m=añadirNoticia" method="post" id="noticia_formulario">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Ej: Greta Thunberg" required>

                    <label for="noticia">Contenido</label>
                    <textarea name="noticia" id="noticia" rows="5" placeholder="Escribe el contenido de la noticia" required></textarea>

                    <label for="url">URL de la imagen</label>
                    <input type="text" name="url" id="url" placeholder="Ej: https://..." required>

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <label>Cuestionario</label>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pregunta</label>
                            <input type="text" name="preguntas[]" placeholder="Escribe la pregunta" required>

                            <label>Opciones (separadas por '/')</label>
                            <input type="text" name="opciones[]" class="opciones" placeholder="Opción1/Opción2/Opción3" required>

                            <label>Respuesta correcta</label>
                            <input type="number" name="respuestas_correctas[]" min="1" placeholder="Número de la respuesta correcta" required>
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
        
        <div id="ultimasDiezNoticias">
            <h2>Últimas 10 Noticias</h2>
            <?php if (isset($noticias) && !empty($noticias)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Noticia</th>
                            <th>Fecha Programada</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($noticias as $noticia) {
                            echo '<tr>
                                    <td>' . $noticia['idNoticia'] . '</td>
                                    <td>' . $noticia['titulo'] . '</td>
                                    <td>' . ($noticia['fechaProgramada'] ?? 'No programada') . '</td>
                                    <td style="text-align: center;" ><a href="index.php?c=GestionarNoticias&m=modificar&idNoticia=' . $noticia['idNoticia'] . '">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a></td>
                                    <td style="text-align: center;"><a href="index.php?c=GestionarNoticias&m=eliminar&idNoticia=' . $noticia['idNoticia'] . '" 
                                        onclick="return confirm(\'¿Eliminar esta noticia?\')">
                                        <i class="fa-regular fa-circle-xmark"></i>
                                    </a></td>
                                </tr>';

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


        <!-- Formulario de buscar -->
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



        <?php if (isset($noticia) && isset($preguntas) && isset($opciones_implode) && isset($respuestas)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener los datos
                let noticia = <?php echo json_encode($noticia); ?>;
                let preguntas = <?php echo json_encode($preguntas); ?>;
                let opcionesImplode = <?php echo json_encode($opciones_implode); ?>;
                let respuestas = <?php echo json_encode($respuestas); ?>;



                // Cambiar el action para cambiar el metodo a modificar
                let form = document.getElementById('noticia_formulario');
                form.action = `index.php?c=GestionarNoticias&m=modificar&idNoticia=${noticia.idNoticia}`;
                


                // Obtener los inputs del DOM
                let inputTitulo = document.getElementById('titulo');
                let textareaNoticia = document.getElementById('noticia');
                let inputUrl = document.getElementById('url');
                let inputFecha = document.getElementById('fecha');



                // Rellenar datos de la noticia
                inputTitulo.value = noticia.titulo || '';
                textareaNoticia.value = noticia.noticia || '';
                inputUrl.value = noticia.urlImagen || '';
                
                

                let fechaStr = noticia.fechaProgramada || noticia.fechaCreacion || '';
                if (fechaStr.length >= 10) fechaStr = fechaStr.substring(0,10);
                inputFecha.value = fechaStr;
                
                

                // Contenedor y plantilla
                let contenedor = document.getElementById('cuestionarioContainer');
                let cajaPregunta = document.querySelector('.cuestionarioPregunta');



                if (contenedor && cajaPregunta) {
                    contenedor.innerHTML = ''; // limpiar

                    for (let i = 0; i < preguntas.length; i++) {
                        let p = preguntas[i];
                        let opcionesText = opcionesImplode[i] ?? '';
                        let respuestaVal = respuestas[i] ?? '';

                        let nuevo = document.createElement('div');
                        nuevo.classList.add('cuestionarioPregunta');

                        // Construir un html como las .cuestionarioPregunta
                        nuevo.innerHTML = `
                            <label>Pregunta</label>
                            <input type="text" name="preguntas[]" placeholder="Escribe la pregunta" required>
                            <label>Opciones (separadas por '/')</label>
                            <input type="text" name="opciones[]" class="opciones" placeholder="Opción1/Opción2/Opción3" required>
                            <label>Respuesta correcta</label>
                            <input type="number" name="respuestas_correctas[]" min="1" placeholder="Número de la respuesta correcta" required>
                        `;



                        let inputs = nuevo.querySelectorAll('input');

                        if (inputs[0]) inputs[0].value = p.pregunta || ''; // Pregunta
                        if (inputs[1]) inputs[1].value = opcionesText; // Opciones hechas implode
                        if (inputs[2]) inputs[2].value = respuestaVal; // Respuesta correcta

                        contenedor.appendChild(nuevo);
                    }
                }
            });
        </script>
        <?php endif; ?>


        <!-- Botón para crear más campos para las preguntas. -->
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
