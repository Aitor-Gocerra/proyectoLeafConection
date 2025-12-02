<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require_once 'parciales/head.php';
        encabezado("Registro - LeafConnect");
    ?>
</head>

<body>
    <header>
        <nav class="navegacion-autenticacion">
            <div class="infoJuego">
                <img src="./imagenes/logo.jpg" alt="logo Juego" class="logo">
                <h3>LeafConnect</h3>
            </div>
        </nav>
    </header>
    <main>
        <div id="texto" style="text-align: center; margin-bottom: 2rem;">
            <h1>Crear cuenta</h1>
            <p>¡Únete a Recquiz y aprende nuevos conocimentos!</p>
        </div>

        <form action="POST" class="formulario-autenticacion" action="./controlador/recogerDatos.js">

            <h1>Comenzar</h1>
            <label for="correo">Correo electrónico</label>
            <input type="text" placeholder="Introduce correo" id="input-correo">

            <label for="contrasenia">Contraseña</label>
            <input type="password" placeholder="Introduce tu contraseña" id="input-contrasenia">

            <label for="contrasenia2">Confirmar contraseña</label>
            <input type="password" placeholder="Confirme contraseña" id="input-contrasenia2">

            <div class="error-msg" id="pass-error-msg" style="color: red; font-size: 0.9em;"></div>

            <div id="mensaje-error" style="color: red; margin: 10px 0;"></div>

            <a href="#" id="btn-crearcuenta" class="boton-autenticacion-primario">Crear Cuenta</a> 

            <p>¿Ya tienes cuenta? <a href="index.php?c=Paginas&m=login">Inicia sesión</a></p>
        </form>

    </main>

    <a href="index.php" id="enlaceVolver">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

    <footer>
        <?php
            require_once 'parciales/footer.php';
        ?>
    </footer>

</body>

<script type="module" src="javascript/vista/registrarse.js"></script>

</html>