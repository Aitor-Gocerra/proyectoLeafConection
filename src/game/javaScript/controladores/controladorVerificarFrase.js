
let entradaFrase;
let mensajeResultado;
let botonValidar;


function manejarValidacion(){

    let frase= entradaFrase.value;
    let result= modelos.validarPalabra(palabraUsuario);

}
/** 

@param {object}

*/

function mostrarResultado(resultado){
    mensajeResultado.textContent= resultado.mensaje;

    if (resultado.esCorrecta){
        mensajeResultado.style.color='green';
    }
    else{
        mensajeResultado.style.color='red';
    }   
        
}

function inicializar(){
    entradaFrase= document.getElementById('entradaPalabra');
    mensajeResultado= document.getElementById('mensajeResultado');
    botonValidar= document.getElementById('botonValidar');

    entradaFrase.addEventListener('keypress', function(e){
        if (e.key=='Enter'){
            manejarValidacion();
        }
    });
}

document.addEventListener('DOMContentLoaded', inicializar);









