<?php
    $alert= '';
    #inicio de sesion
    session_start();
    #si la sesion activa no esta vacia redirige a la carpeta de sistema
    if(!empty($_SESSION['active'])){
        header('location: sistema/');
    }else{
        #si lo que se envia no esta vacio
        if (!empty($_POST)){
            #si el usuario o la contraseña esta vacio manda el error de la variable alert
            if(empty($_POST['usuario']) || empty($_POST['clave'])){
                $alert='<div class="alert alert-danger" style="border-radius: 20px;" role="alert">
                            Ingrese su usuario y Contraseña
                        </div>';
            #si la variable post esta vacia          
            }else{
                #solicitud de la conexion de php
                require_once "./conexion/php/conexion.php";
                #asigna el usuario y la contraseña a una variable
                $user = mysqli_real_escape_string($conection,$_POST['usuario']);
                $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));
                
                #compara el usuario y contraseña con la base de datos y lo selecciona
                $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
                $result = mysqli_num_rows($query);
                #si existe o hay algun resultado
                if( $result > 0 ){
                    
                    $data = mysqli_fetch_array($query);
                    #inia sesion 
                    session_start();
                    #asigna 
                    $_SESSION['active'] =true;
                    $_SESSION['idUser'] =$data['idusuario'];
                    $_SESSION['nombre'] =$data['nombre'];
                    $_SESSION['apellido'] =$data['apellido'];
                    $_SESSION['email']  =$data['email'];
                    $_SESSION['user']   =$data['usuario'];
                    $_SESSION['rol']    =$data['rol'];

                    header('location: sistema/');

                }else{

                    $alert='<div class="alert alert-danger" style="border-radius: 20px;" role="alert">
                                El usuario o contraseña son incorrectos
                            </div>';
                
                    session_destroy();

                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistema de Facturacion</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
        <section id="container">
            <form action="" method="post">
                <div class="container">
                    <div class="row"> 
                        <div style="text-align: center;">
                            <h1><b>Iniciar Sesión</b></h1>
                            <img width="200" height="200" src="./img/git.jpeg" class="img-fluid" alt="login">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nombre de Usuario</label>
                                <input type="Text" placeholder="Usuario" name="usuario" class="form-control" id="usuario" >
                            </div>
                            <div class="mb-3">
                                <label for="clave" class="form-label">Contraseña</label>
                                <input type="password" name="clave" placeholder="Contraseña" class="form-control" id="clave">
                            </div>
                            <div class="mb-3">
                                <?php echo(isset($alert)? $alert : ''); ?>
                            </div>
                            <button type="submit" value="INICIAR SESIÓN" class="btn btn-outline-primary" style="border-radius: 20px;" >INICIAR SESIÓN</button>
                        </div>
                    </div> 
                </div>
            </form>
        </section>
   
    
</body>
</html>