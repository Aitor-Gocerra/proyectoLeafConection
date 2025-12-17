<!DOCTYPE html>
<html lang="en">

<head>
        <?php
            require_once 'parciales/head.php';
            encabezado("Admin Login - LeafConnect");
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
            <p>Introduce tus datos para acceder al admin.</p>
            
            <label for="input-email">Correo electrónico</label>
            <input type="text" id="input-email" placeholder="Introduce correo"> 
            
            <div class="info-password-label">
                <label for="input-password" id="tituloPw">Contraseña</label>
                <span id="iconoPw">🔒</span> 
            </div>
            <input type="password" id="input-password" placeholder="Introduce contraseña">
            

            <div id="mensaje-error"></div>
            
            <button type="button" id="btn-login" class="boton-autenticacion-primario">Iniciar Sesión</button>
        </form>

    </main>

    <footer>
        <?php
        require_once 'parciales/footer.php';
        ?>
    </footer>
    <script src="javascript/modelos/mIniciarsesion.js"></script>
    <script src="javascript/controladores/cIniciarsesion.js"></script>
    <script src="javascript/vistas/vIniciarsesion.js"></script>
    <script src="javascript/app.js"></script>
</body>

</html>