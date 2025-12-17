// Esperar a que el DOM (la página HTML) esté completamente cargada
document.addEventListener('DOMContentLoaded', function () {

    // Obtener el título de la página desde el <head>
    const tituloCompleto = document.title;

    // Variable para guardar qué tipo de página es
    let tipoPagina = null;

    // Determinar el tipo de página según el título
    if(tituloCompleto.includes('Noticia')){
        tipoPagina = 'Noticia';
    }else{
        tipoPagina = 'Login';
    }

    // Inicializar el MVC correspondiente según el tipo de página
    switch (tipoPagina) {
        case 'Noticia':
            const modeloNoticia = new MNoticia();
            const controladorNoticia = new CNoticia(modeloNoticia, null);
            const vistaNoticia = new VNoticia(controladorNoticia);
            controladorNoticia.vista = vistaNoticia;
            break;

        case 'Login':
            const modeloIniciosesion = new MIniciarsesion();
            const controladorInicio = new CIniciarsesion(modeloIniciosesion, null);
            const vistaIniciarsesion = new VIniciarsesion(controladorInicio);
            controladorInicio.vista = vistaIniciarsesion;
            break;

        default:
            console.warn('No se reconoció el tipo de página: ' + tituloCompleto);
            break;
    }
});
