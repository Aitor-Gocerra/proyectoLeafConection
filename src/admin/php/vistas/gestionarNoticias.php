<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Gestión de Noticias - LeafConnect");
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
        
        <section id='buscadorNoticias'>
            <h2>Buscar NoticiaAAA</h2>
            <form id='formBuscarNoticia'>
                <input type='search' id='inputBuscarNoticia' name='buscar' placeholder='Introduce una palabra clave...' aria-label='Buscar $titulo'>
                <button type='submit'>
                    <i class='fas fa-search'></i> Buscar
                </button>
            </form>
        </section>
                

            <?php
                if (isset($resultadosBusqueda) && !empty($resultadosBusqueda)) {
                    
                    echo
                    '<div id="resultadosBusquedaNoticias">
                        <h2>Resultados de la Búsqueda</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Fecha Programada</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>';
                        foreach ($resultadosBusqueda as $noticia) {

                            // Darle formato a la fecha para quitar las horas, minutos y segundos.
                            $fecha = $noticia['fechaProgramada'] ?? null;
                    
                            if ($fecha) {
                                $fechaFormato = date("d-m-Y", strtotime($fecha));
                            } else {
                                $fechaFormato = "No programada";
                            }

                            echo
                                '<tr>' .
                                    '<td>' . $noticia['idNoticia'] . '</td>' .
                                    '<td>' . $noticia['titulo'] . '</td>' .
                                    '<td>' . $fechaFormato . '</td>' .
                                    '<td class="tc">
                                        <button class="btnModificar" data-id="' . $noticia['idNoticia'] . '">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>' .
                                    '<td class="tc">
                                        <button class="btnEliminar" data-id="' . $noticia['idNoticia'] . '">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </button>
                                    </td>' .
                                '</tr>';
                        }
                    echo
                            '</tbody>
                        </table>
                    </div>';
                } elseif (isset($_GET['buscar'])) {
                    echo '<div class="mensaje"><p>No se encontraron noticias con el término: ' . $_GET['buscar'] . '</p></div>';
                }

                if (isset($mensaje)){
                    echo $mensaje;
                }
            ?>


            <div id="contenedorAdmin">
                <h1>Gestión de noticias</h1>
                <form action="./index.php?c=Noticias&m=añadirNoticia" method="post" id="noticia_formulario">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Ej: Greta Thunberg">

                    <label for="noticia">Contenido</label>
                    <textarea name="noticia" id="noticia" rows="5" placeholder="Escribe el contenido de la noticia"></textarea>

                    <label for="url">URL de la imagen</label>
                    <input type="text" name="url" id="url" placeholder="Ej: https://...">

                    <label for="fecha">Fecha programada</label>
                    <input type="date" name="fecha" id="fecha">

                    <label>Cuestionario</label>

                    <div id="cuestionarioContainer">
                        <div class="cuestionarioPregunta">
                            <label>Pregunta</label>
                            <input type="text" name="preguntas[]" placeholder="Escribe la pregunta">

                            <label>Opciones (separadas por '/')</label>
                            <input type="text" name="opciones[]" class="opciones" placeholder="Opción1/Opción2/Opción3">

                            <label>Respuesta correcta</label>
                            <input type="number" name="respuestas_correctas[]" min="1" placeholder="Número de la respuesta correcta">
                        </div>
                    </div>

                    <input type="submit" value="Guardar noticia" id="btnEnviar">
                </form>

                <button type="button" id="btnAnadirPregunta">
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
                            $fecha = $noticia['fechaProgramada'] ?? null;

                            if ($fecha) {
                                $fechaFormato = date("d-m-Y", strtotime($fecha));
                            } else {
                                $fechaFormato = "No programada";
                            }

                            echo '<tr>
                                    <td>' . $noticia['idNoticia'] . '</td>
                                    <td>' . $noticia['titulo'] . '</td>
                                    <td>' . $fechaFormato . '</td>'.
                                    '<td class="tc">
                                        <button class="btnModificar" data-id="' . $noticia['idNoticia'] . '">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>' .
                                    '<td class="tc">
                                        <button class="btnEliminar" data-id="' . $noticia['idNoticia'] . '">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </button>
                                    </td>' .
                                '</tr>';

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

        <script src="javaScript/modelos/mNoticia.js"></script>
        <script src="javaScript/controladores/cNoticia.js"></script>
        <script src="javaScript/vistas/vNoticiaDia.js"></script>
        <script src="javaScript/app.js"></script>
    </body>
</html>