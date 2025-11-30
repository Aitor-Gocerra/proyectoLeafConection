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
        <nav>
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

        <form action="" class="formulario-autenticacion">

            <h1>Comenzar</h1>
            <label for="">Correo electrónico</label>
            <input type="text" placeholder="Introduce correo">

            <label for="">Contraseña</label>
            <input type="password" placeholder="Introduce tu contraseña">

            <label for="">Confirmar contraseña</label>
            <input type="password" placeholder="Confirme contraseña">

            <input type="submit" class="boton-autenticacion-primario" value="Crear cuenta">

            <p>¿Ya tienes cuenta? <a href="index.php?c=Paginas&m=login">Inicia sesión</a></p>
        </form>

    </main>

    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>

</body>

</html>