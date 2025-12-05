
// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', () => {
    // Crear instancias del MVC
    const modelo = new MPalabra();
    const controlador = new CPalabra(modelo, null); // Vista se crea después
    const vista = new VPalabra(controlador);

    // Asignar la vista al controlador
    controlador.vista = vista;

    console.log('MVC de Palabra inicializado correctamente');
});
