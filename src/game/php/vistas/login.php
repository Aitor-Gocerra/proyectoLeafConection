<!DOCTYPE html>
<html lang="en">

<head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Login - LeafConnect");
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

       <form action="" id="form-login" class="formulario-autenticacion"> 
            <p>Introduce tus datos para acceder a tu cuenta.</p>
            
            <label for="input-email">Correo electrónico</label>
            <input type="text" id="input-email" placeholder="Introduce correo"> 
            
            <div class="info-password-label">
                <span id="iconoPw">🔒</span> 
                <label for="input-password" id="tituloPw">Contraseña</label>
            </div>
            <input type="password" id="input-password" placeholder="Introduce contraseña">
            

            <div id="mensaje-error"></div>
            
            <button type="button" id="btn-login" class="boton-autenticacion-primario">Iniciar Sesión</button>
            <a href="index.php?c=Usuarios&m=mostrarInicio" class="boton-autenticacion-secundario">Jugar como invitado</a>
            <p>¿No tienes cuenta? <a href="index.php?c=Usuarios&m=registro">Regístrate</a></p>
        </form>

    </main>

    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>
    <script src="javaScript/modelos/mIniciarsesion.js"></script>
    <script src="javaScript/controladores/cIniciarsesion.js"></script>
    <script src="javaScript/vistas/vIniciarsesion.js"></script>
    <script src="javaScript/app.js"></script>
</body>

</html>