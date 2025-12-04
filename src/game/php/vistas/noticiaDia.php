<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Noticia del día - LeafConnect");
        ?>
    </head>
    <body>
        <header>
            <?php
                require_once 'parciales/nav.php';
            ?>
        </header>
        
        <main id="noticia_contenedor" class="contenedor_noticia">
            <section id="noticia_seccion_principal">
                <div id="noticia_titulo">
                    <h1>
                        <?php echo $noticia['titulo']; ?>
                    </h1>
                </div>
                <div id="noticia_imagen">
                    <div id="imagen" style="background-image: url('<?php echo $noticia['urlImagen']; ?>')"></div>
                </div>

                <div id="noticia_contenido">
                    <p class="noticia_parrafo">
                        <?php echo $noticia['noticia']; ?>
                    </p>
                </div>
            </section>
            
            <section id="noticia_seccion_pregunta">
                <h3 class="subtitulo">
                    Prueba tus conocimientos
                </h2>

                <form id="formNoticia" action="./index.php?c=Noticias&m=guardarPartidaNoticiaDia&idNoticia=<?php echo $noticia['idNoticia']; ?>" method="post">

                <?php
                    foreach($preguntas as $pregunta){
                        echo 
                            '<div class="noticia_pregunta">' .
                                '<h4>' . $pregunta['pregunta'] . '<h4>' .
                                '<ul>';
                                    foreach ($opciones as $opcion) {
                                        if ($opcion['nPregunta'] == $pregunta['nPregunta']){
                                            echo '<li><input type="radio" name="'. $pregunta['nPregunta'] .'" value="'.$opcion['nOpcion'] .'">' . $opcion['opcion'] .'</li>';
                                        }
                                    }
                        echo    '</ul>' .
                            '</div>';

                    }
                ?>
                    <input type="hidden" name="tiempo" value="180">
                    <input type="submit" value="Enviar respuesta" id="btnEnviar">
                    <?php
                        if (isset($mensaje)) {
                            echo '<h4>¡' . $mensaje . '!</h4>'; // Mostrar como popup la cantidad de puntos obtenidos
                        }
                    ?>
                </form>
            </section>
        </main>
        <?php
            require_once 'parciales/botonVolver.php';
        ?>
        <footer>
            <?php
                require_once 'parciales/footer.php';
            ?>
        </footer>

        <script>
            // Obtengo las respuestas correctas y las del usuario desde el php convertidas a objetos
            let respuestasCorrectas = <?php echo isset($respuestasCorrectas) ? json_encode($respuestasCorrectas) : '{}'; ?>;
            let respuestasUsuario   = <?php echo isset($respuestasUsuario)   ? json_encode($respuestasUsuario)   : '{}'; ?>;

            // Esperar a que el DOM esté completamente cargado
            document.addEventListener('DOMContentLoaded', function() {
                let form = document.getElementById('formNoticia');
                let btnEnviar = document.getElementById('btnEnviar');

                if (btnEnviar) {
                    btnEnviar.addEventListener('click', function() {
                        this.disabled = true; // Desactivar boton submit
                    });
                }

                if (form && respuestasCorrectas && respuestasUsuario) {
                    // Restaurar lo qeu ha marcado el jugador
                    for (let nPregunta in respuestasUsuario) {
                            if (respuestasUsuario.hasOwnProperty(nPregunta)) {
                                let valorUsuario = String(respuestasUsuario[nPregunta]);
                                let input = form.querySelector(
                                    `input[type="radio"][name="${nPregunta}"][value="${valorUsuario}"]`
                                );
                                if (input) {
                                    input.checked = true;
                                }
                            }
                        }

                    // Colocar la imagen si ha acertado o no
                    for (let nPregunta in respuestasCorrectas) {
                        if (respuestasCorrectas.hasOwnProperty(nPregunta)) {
                            let opcionCorrecta = String(respuestasCorrectas[nPregunta]);
                            let opcionUsuario  = (respuestasUsuario && respuestasUsuario[nPregunta] !== undefined) ? String(respuestasUsuario[nPregunta]) : null;

                            // Coge todos los radios de esa pregunta
                            let inputs = form.querySelectorAll(
                                `input[type="radio"][name="${nPregunta}"]`
                            );

                            inputs.forEach(input => {
                                let li = input.closest('li');
                                let valor = String(input.value);

                                // Marchar respuestas CORRECTAS
                                if (valor === opcionCorrecta) {
                                    let iconCheck = document.createElement('i');
                                    iconCheck.className = 'fa-regular fa-circle-check';
                                    li.appendChild(iconCheck);
                                }

                                // Marcar respuestas INCORRECTAS
                                if (opcionUsuario !== null && valor === opcionUsuario && valor !== opcionCorrecta) {
                                    let iconX = document.createElement('i');
                                    iconX.className = 'fa-regular fa-circle-xmark';
                                    li.appendChild(iconX);
                                }
                            });
                        }
                    }
                }
            });
        </script>
    </body>
</html>