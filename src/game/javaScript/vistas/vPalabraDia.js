class VPalabra {

    constructor(cPalabra){
        this.contenedor = document.querySelector('.contenedorAcierto');
        this.inputRespuesta = document.querySelector('.introducirPalabra');

        this.controlador = this.controlador;
        this.botonRespuesta = document.querySelector('.enviarPalabra');

        //Logica del boton
        this.botonRespuesta.addEventListener('click', () => {
            const palabra = this.controlador.obtenerPalabraCorrecta();
            this.renderizarPalabraCorrecta(palabra);
        })
    }

    renderizarPalabraCorrecta(palabra) {
        this.contenedor.innerHTML = ''; //Eliminamos todo lo que hay en el contenedor

        const divRespuesta = document.createElement('div');
        divRespuesta.className = 'zonaRespuesta';
        divRespuesta = `
            <p>La respuesta correcta es:</p>
            <h3 id="textoSolucion" style="color: #27ae60; text-transform: uppercase;"></h3>
        `;
        this.contenedor.appendChild(divRespuesta);
    }
}