<?php
    $host ='localhost';
    $user = 'root';
    $password = 'jehova22';
    $db = 'sistema de facturacion';

    $conection = @mysqli_connect($host,$user,$password,$db);
    if(!$conection){
        echo "Error de Conexión";
    }
?>