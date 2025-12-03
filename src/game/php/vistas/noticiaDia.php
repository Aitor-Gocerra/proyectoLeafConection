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

                <form action="">

                    <?php 
                        foreach($preguntas as $pregunta){
                            echo 
                                '<div class="noticia_pregunta">' .
                                    '<h4>' . $pregunta['pregunta'] . '<h4>' .
                                    '<ul>';
                                        foreach ($opciones as $opcion) {
                                            if ($opcion['nPregunta'] == $pregunta['nPregunta']){
                                                echo '<li><input type="radio" name="'. $pregunta['nPregunta'] .'" value="'.$opcion['nOpcion'] .'">' . $opcion['opcion'] .'></li>';
                                            }
                                        }
                            echo    '</ul>' .
                                '</div>';

                        }
                    ?>

                    <!-- <div class="noticia_pregunta">
                        <h4>1. ¿Por qué los niños del año 2020 podrían sufrir más eventos climáticos extremos que generaciones anteriores? <i class="fa-regular fa-circle-check"></i></h4>
                        <ul>
                            <li><input type="radio" name="1">Porque el cambio climático está aumentando la frecuencia de fenómenos extremos.</li>
                            <li><input type="radio" name="1">Porque ahora se registran mejor los datos y parece que hay más sucesos.</li>
                            <li><input type="radio" name="1">Porque la población infantil es mucho mayor que antes.</li>
                        </ul>
                    </div>

                    <div class="noticia_pregunta">
                        <h4>2. ¿Por qué los niños con menos recursos pueden tener más dificultades ante el cambio climático? <i class="fa-regular fa-circle-xmark"></i></h4>
                        <ul>
                            <li><input type="radio" name="2">Porque viven en condiciones con menos acceso a agua, zonas verdes o sistemas de refrigeración.</li>
                            <li><input type="radio" name="2">Porque están menos interesados en informarse sobre el clima.</li>
                            <li><input type="radio" name="2">Porque no tienen la posibilidad de viajar a otros países con mejor clima.</li>
                        </ul>
                    </div> -->

                    <input type="submit" value="Enviar respuesta">
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
    </body>
</html>