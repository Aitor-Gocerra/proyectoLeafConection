
class contVerifPalabra{
    constructor(modelo, palabra){
        this.modelo= modelo;
        this.palabra=palabra;
        this.palabraCorrectaOno= null;
    }
    t
    /** 
    @returns {Promise<Object>}
    
    */

    async inicializar(){
        try{
            let datos= await this.modelo.obtenerPalabraCorrecta();
            this.palabraCorrectaOno= datos.palabra;
            console.log('La palabra cargada es correctamente');
        } catch (error){
            console.log('Controlador: Error al inicializar')
            this.vistas
        } 
    }

    /** 
    @param {string}
    
    */
    validarRespuesta(palabraUsuario){
        if(!palabraUsuario || palabraUsuario.trim()==''){
            this.vista
            return;
        }
        if (!this.palabraCorrectaOno){
            this.vista
            return;
        }
    }

    mostrarRespuesta(){
        if (!this.palabraCorrectaOno){
            this.vista
        } else{
            this.vista
        }
    }

    

}


