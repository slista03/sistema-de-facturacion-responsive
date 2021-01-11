<?php
    include "../conexion/conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['pass']) || empty($_POST['rol'])){
            $alert='<div class="alert alert-danger" role="alert">
            Todos los campos son obligatorios.
          </div>';
        }else{
            
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $email=$_POST['correo'];
            $user=$_POST['usuario'];
            $pass= md5($POST[$pasword]);
            $rol=$_POST['rol'];

            
            $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
            mysqli_close($conection);
            $result = mysqli_fetch_array($query);
            if ($result > 0){
                $alert = '<div class="alert alert-danger" role="alert">>El Correo o el Usuario ya existe.
              </div>';
            }else{
                $query_insert = mysqli_query($conection," INSERT INTO usuario(nombre,apellido,correo,usuario,clave,rol) Values('$nombre', '$apellido', '$email', '$user', '$pass','$rol')");
                if($query_insert){
                    $alert = '<div class="alert alert-success" role="alert">
                    Usuario creado correctamente.
                  </div>';
                }else{
                    $alert = '<div class="alert alert-danger" role="alert">ERROR al crear el usuario.
                  </div>';
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
	<?php include "./includes/scripts.php"; ?>
	<title>Registro de Usuarios</title>
</head>
<body>
	<?php include "./includes/header.php"; ?>
	<div class="container mt-3" > 
        <section id="container">
		
            <div class="container">
                <h1>Registro de Usuarios</h1>
                <hr>
                <div class="alert">
                    <?php echo isset($alert) ? $alert : ""; ?>
                </div>
                <form action="" method="post">

                    <label for="nombre">Nombre</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-user"></i></div>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Pablo">
                    </div>

                    <label for="apellido">Apellido</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-user"></i></div>
                        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Cortéz">
                    </div>

                    <label for="correo">Correo Electrónico</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        <input type="email" name="correo" class="form-control" id="correo" placeholder="nombre@midominio.com">
                    </div>

                    <label for="usuario">Usuario</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de Usuario">
                    </div>

                    <label for="pass">Contraseña</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        <input type="password" name="pass1" class="form-control" id="pass1" placeholder="contraseña">
                    </div>
                    <label for="pass">Confirmar Contraseña</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        <input type="password" name="pass2" class="form-control" id="pass2" placeholder="contraseña">
                    </div>
                    <?php
                        $pass1=$_GET['pass1'];
                        $pass2=$_GET['pass2'];
                        if ($pass1 != $pass2){
                            $alert= '<div class="alert alert-danger" style="border-radius: 20px;" role="alert">
                            Las contraseñas no coinciden
                            </div>';
                            $pasword="";
                        }else{
                            $alert = '<div class="alert alert-danger" style="border-radius: 20px;" role="alert">
                            Contraseñas coinciden exito.
                        </div>';
                        $pasword=$pass1;
                        }
                    ?>
                    <label for="rol">Tipo de Usuario</label>
                    <?php 
                        $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                        mysqli_close($conection);
                        $result_rol = mysqli_num_rows($query_rol);                  
                    ?>
                    <div class="mb-3">
                        <div class="input-group is-invalid">
                                <label class="input-group-text" for="validatedInputGroupSelect"><i class="fas fa-user-tag"></i></label>
                            <select class="form-select" name="rol" id="rol">
                                <?php 
                                    if ($result_rol > 0){
                                        while($rol = mysqli_fetch_array($query_rol)){
                                            ?>
                                            <option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol']; ?>  </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 btn-center">
                        <button type="submit" class="btn btn-outline-success">Crear Usuario</button>
                    </div>
                    
                </form>
            </div>
        </section>
    </div>
	<?php include "./includes/footer.php" ?>
</body>
</html>