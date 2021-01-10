<?php
    $host ='localhost';
    $user = 'root';
    $password = '';
    $db = 'sistema de facturacion';

    $conection = @mysqli_connect($host,$user,$password,$db);
    if(!$conection){
        echo "Error de Conexión";
    }
?>