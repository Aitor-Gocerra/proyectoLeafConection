<!DOCTYPE html>
<html lang="en">
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
            <div id="noticia_imagen">
                <img src="https://image.ondacero.es/clipping/cmsimages02/2025/06/05/9C80A238-0A5F-4FC8-B6A0-B86C56A5D664/infancia-espanola-frente-clima-nacidos-2020-sufriran-tres-veces-mas-extremos-climaticos-que-sus-abuelos_96.jpg?crop=5184,2916,x0,y273&width=1200&height=675&optimize=low&format=webply" alt="cambioClimatico">
            </div>

            <div id="noticia_contenido">
                <h1 id="noticia_titulo">
                    Nacidos en 2020 sufrirán el triple de extremos climáticos
                </h1>
                <p class="noticia_parrafo">
                    Los fenómenos climáticos extremos dejarán de ser excepcionales. Según el informe, los 
                    niños de Aragón (97%), Cataluña (96%) y La Rioja (94%) serán los más expuestos a sufrir, 
                    cada año, al menos un evento climático extremo: olas de calor, inundaciones, sequías, 
                    incendios o pérdidas de cosechas. Si el calentamiento se estabilizara en 1,5°C -el 
                    objetivo del Acuerdo de París-, esta exposición se reduciría drásticamente al 65%.<br></br>
                    
                    El documento aporta una poderosa visualización: hasta 111 millones de niños nacidos en 
                    2020 podrían sufrir olas de calor extremas a lo largo de su vida si la temperatura global 
                    alcanza los 3,5°C. Pero limitar el calentamiento a 1,5°C evitaría esta exposición para 
                    38 millones de ellos.<br></br>
                </p>
            </div>
        </section>
        
        <section id="noticia_seccion_pregunta">
            <h3 class="subtitulo">
                Prueba tus conocimientos
            </h2>

            <form action="">
                <div class="noticia_pregunta">
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
                </div>

                <input type="submit" value="Enviar respuesta">
            </form>
        </section>
    </main>
    <footer>
        <?php
            require_once 'parciales/footer.php';
        ?>
    </footer>
</body>
</html>