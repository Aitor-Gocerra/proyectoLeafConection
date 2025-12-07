
class modeloFrase{
    
constructor(modelo, frase){
    this.modelo=modelo;
    this.frase= frase;
}

verificarFrase(frase){
    let limpia= frase.trim().replace(/\s/g, ''); /* trim: se utiliza para que no haya espacios y replace:  */
    limpia= limpia.toUpperCase(); /* utiliza la palabra en mayúsculas */
    
    return limpia;

}
quitarAcentos(texto){
    return texto.replace(/[\u0300-\u036f]/g, ''); 
}


validarPalabra(palabraUsuario){
    if (!palabraUsuario || palabraUsuario.trim()==''){
        return 'La frase no está correcta';
    
    } else{
        return 'La frase introducido es la correcta';
    }

    }





}











