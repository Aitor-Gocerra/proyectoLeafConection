<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/estilos.css">
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
            
            <label for="input-password">Contraseña</label>
            <input type="password" id="input-password" placeholder="Introduce contraseña"> 

            <div id="mensaje-error"></div>
            
            <button type="button" id="btn-login" class="boton-autenticacion-primario">Iniciar Sesión</button>
            <a href="index.php?c=Paginas&m=inicio" class="boton-autenticacion-secundario">Jugar como invitado</a>
            <p>¿No tienes cuenta? <a href="index.php?c=Paginas&m=registro">Regístrate</a></p>
        </form>

    </main>

    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>
    <script type="module" src="javascript/vista/iniciarsesion.js"></script>
</body>

</html>