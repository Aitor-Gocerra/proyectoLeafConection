<?php       
function titulo($titulo){
    echo "
        <section id='buscadorFrasesPalabra'>
            <h2>Buscar $titulo a Modificar</h2>
            <form action='#' method='get'>
                <input type='search' id='inputBuscar' name='query' placeholder='Introduce una palabra clave o parte de la palabra...' aria-label='Buscar frase a modificar'>
                <button type='submit'>
                    <i class='fas fa-search'></i> Buscar
                </button>
            </form>
        </section>
    ";
}
?>
