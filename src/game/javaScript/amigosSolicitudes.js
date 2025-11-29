const btnAmigos = document.getElementById("todosAmigos");
const btnSolicitudes = document.getElementById("solicitudesAmigos");
const misAmigos = document.getElementById("misAmigos");
const misSolicitudes = document.getElementById("misSolicitudes");

btnAmigos.addEventListener("click", () => {
    misAmigos.style.display = "block";
    misSolicitudes.style.display = "none";

    btnAmigos.classList.add("botonActivo");
    btnAmigos.classList.remove("botonNoActivo");

    btnSolicitudes.classList.add("botonNoActivo");
    btnSolicitudes.classList.remove("botonActivo");
});

btnSolicitudes.addEventListener("click", () => {
    misAmigos.style.display = "none";
    misSolicitudes.style.display = "block";

    btnSolicitudes.classList.add("botonActivo");
    btnSolicitudes.classList.remove("botonNoActivo");

    btnAmigos.classList.add("botonNoActivo");
    btnAmigos.classList.remove("botonActivo");
});
