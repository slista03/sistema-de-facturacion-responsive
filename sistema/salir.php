<?php
    /* inicia sesion */
    session_start();
    // destruye la sesion para no volver a ingresar
    session_destroy();
    // redirecciona al index del directorio anterior
    header('location: ../index.php');
?>