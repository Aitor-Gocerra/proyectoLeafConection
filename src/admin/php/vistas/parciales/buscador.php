<?php
function titulo($titulo)
{
    echo "
        <section id='buscadorFrasesPalabra'>
            <h2>Buscar $titulo</h2>
            <form id='formBuscar'>
                <input type='search' id='inputBuscar' name='buscar' placeholder='Introduce una palabra clave...' aria-label='Buscar $titulo'>
                <button type='submit'>
                    <i class='fas fa-search'></i> Buscar
                </button>
            </form>
        </section>
    ";
}
?>


