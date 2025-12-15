// Funcionalidad del menú desplegable
const fotoPerfil = document.getElementById('fotoPerfil');
const menuDesplegable = document.getElementById('menuDesplegable');

fotoPerfil.addEventListener('click', function() {
    if (menuDesplegable.style.display === 'block') {
        menuDesplegable.style.display = 'none';
    } else {
        menuDesplegable.style.display = 'block';
    }
});

// Cerrar el menú al hacer clic fuera
window.addEventListener('click', function(event) {
    if (event.target.id !== 'fotoPerfil' && !menuDesplegable.contains(event.target)) {
        menuDesplegable.style.display = 'none';
    }
});