class MPalabra {
    
    constructor(){
        this.API_URL = '';
    }

    async obtenerPalabraCorrecta(){
        try {
            const respuesta = await fetch(this.API_URL);

            if(!respuesta.ok){
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            const datos = await respuesta.json();

            return datos.results;

        } catch (error){
            console.error('Modelo: Error al obtener la respuesta:', error);
            throw error;
        }
    }
}