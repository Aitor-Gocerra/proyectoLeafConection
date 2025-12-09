
// Esperar a que el DOM (la página HTML) esté completamente cargada
document.addEventListener('DOMContentLoaded', function () {

    // Obtener el título de la página desde el <head>
    const tituloCompleto = document.title;

    // Variable para guardar qué tipo de página es
    let tipoPagina = null;

    // Determinar el tipo de página según el título
    if (tituloCompleto.includes('Palabra')) {
        tipoPagina = 'Palabra';
    } else if (tituloCompleto.includes('Frase')) {
        tipoPagina = 'Frase';
    } else if (tituloCompleto.includes('Estadisticas')) {
        tipoPagina = 'Estadisticas';
    } else {
        tipoPagina = 'Noticia';
    }

    // Inicializar el MVC correspondiente según el tipo de página
    switch (tipoPagina) {

        case 'Palabra':
            const modeloPalabra = new MPalabra();
            const controladorPalabra = new CPalabra(modeloPalabra, null);
            const vistaPalabra = new VPalabra(controladorPalabra);
            controladorPalabra.vista = vistaPalabra;
            break;

        case 'Frase':
            const modeloFrase = new MFrase();
            const controladorFrase = new CFrase(modeloFrase, null);
            const vistaFrase = new VFrase(controladorFrase);
            controladorFrase.vista = vistaFrase;
            break;
            
        /*case 'Noticia':
            const modeloNoticia = new MNoticia();
            const controladorNoticia = new CNoticia(modeloNoticia, null);
            const vistaNoticia = new VNoticia(controladorNoticia);
            controladorNoticia.vista = vistaNoticia;
            break;*/

        case 'Estadisticas':
            const modeloEstadisticas = new MEstadisticas();
            const controladorEstadisticas = new CEstadisticas(modeloEstadisticas, null);
            const vistaEstadisticas = new VEstadisticas(controladorEstadisticas);
            controladorEstadisticas.vista = vistaEstadisticas;
            break;

        default:
            console.warn('No se reconoció el tipo de página: ' + tituloCompleto);
            break;
    }
});
