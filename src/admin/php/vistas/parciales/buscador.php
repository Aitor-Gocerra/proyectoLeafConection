<?php
function titulo($titulo, $controller, $method)
{
    echo "
        <section id='buscadorFrasesPalabra'>
            <h2>Buscar $titulo a Modificar</h2>
            <form action='index.php' method='get'>
                <input type='hidden' name='c' value='$controller'>
                <input type='hidden' name='m' value='$method'>
                <input type='search' id='inputBuscar' name='query' placeholder='Introduce una palabra clave o parte de la palabra...' aria-label='Buscar frase a modificar'>
                <button type='submit'>
                    <i class='fas fa-search'></i> Buscar
                </button>
            </form>
        </section>
    ";
}
?>