    let input = document.querySelector('.introducirPalabra');
    let boton = document.querySelector('.enviarPalabra');
    let mensaje = document.getElementById('mensaje');

    const palabraCorrecta = "salvar"; // <-- aquí pones la opción correcta

    boton.addEventListener('click', function () {
        const valor = input.value.trim().toLowerCase();

        if (valor === palabraCorrecta) {
            mensaje.style.display = "block";
            mensaje.style.color = "green";
            mensaje.textContent = "¡Correcto!";
        } else {
            mensaje.style.display = "none";
            mensaje.style.color = "red";
            mensaje.textContent = "Ha sido un errorX ";
        }
    });

    



