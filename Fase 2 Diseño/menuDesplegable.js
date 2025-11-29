const fotoPerfil = document.getElementById('fotoPerfil');
const menuDesplegable = document.getElementById('fotoPerfilMenu');

fotoPerfil.addEventListener('click', function(){
    if(menuDesplegable.style.display === 'block'){
        menuDesplegable.style.display = 'none';
    }else{
        menuDesplegable.style.display = 'block';
    }
});

window.addEventListener('click', function(){
    if(event.target.id !== 'fotoPerfil' && !menuDesplegable.contains(this.event.target)){
        menuDesplegable.style.display = 'none';
    }
});