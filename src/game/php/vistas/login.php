<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
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

        <form action="" class="formulario-autenticacion">
            <h1 id="textH1">¡Bienvenido de nuevo!</h1>
            <p>Introduce tus datos para acceder a tu cuenta.</p>
            <label for="">Correo electrónico</label>
            <input type="text" placeholder="Introduce correo">
            <label for="">Contraseña</label>
            <input type="password" placeholder="Introduce contraseña">

            <input type="submit" class="boton-autenticacion-primario" value="Crear cuenta">
            <input type="submit" class="boton-autenticacion-secundario" value="Jugar como invitado">
            <p>¿No tienes cuenta? <a href="index.php?c=Paginas&m=registro">Regístrate</a></p>
        </form>

    </main>

    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>
</body>

</html>