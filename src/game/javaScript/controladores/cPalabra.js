class CPalabra {
    constructor(modelo, vista){
        this.modelo = modelo;
        this.vista = vista;
    }

    async obtenerPalabraCorrecta(){
        try {
            const respuestaCorrecta = await this.modelo.obtenerPalabraCorrecta();

            /*this.vista. */
        } catch (error){
            
        }
    }
}