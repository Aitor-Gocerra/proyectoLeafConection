<?php 
    $nombreUsuario = $_SESSION['usuario'] ?? 'Invitado';

    echo '<h1>¡Bienvenido, '. $nombreUsuario.'!</h1>';
?>

