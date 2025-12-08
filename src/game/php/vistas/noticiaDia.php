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
                                '<h4>' . $pregunta['pregunta'] . '</h4>' .
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
            // Envío los arrays de respuestas a js convertidas a objetos.
            window.idNoticia = <?php echo isset($noticia['idNoticia']) ? $noticia['idNoticia'] : 'null'; ?>;
            window.respuestasCorrectas = <?php echo isset($respuestasCorrectas) ? json_encode($respuestasCorrectas) : '{}'; ?>;
            window.respuestasUsuario   = <?php echo isset($respuestasUsuario)   ? json_encode($respuestasUsuario)   : '{}'; ?>;
        </script>

        <script type="module" src="./js/vistas/noticiaDia.js"></script>
    </body>
</html>