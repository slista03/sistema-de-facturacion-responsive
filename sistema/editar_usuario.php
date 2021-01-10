<?php
    include "../conexion/conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])){
            $alert='<div class="alert alert-danger" role="alert">
            Todos los campos son obligatorios.
          </div>';
        }else{
            $idUsuario=$_POST['idUsuario'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $email=$_POST['correo'];
            $user=$_POST['usuario'];
            $pass= md5($_POST['pass']);
            $rol=$_POST['rol'];

            
            $query = mysqli_query($conection,"SELECT * FROM usuario WHERE (usuario = '$user' AND  idUsuario != $idUsuario) OR (correo = '$email' AND idUsuario != $idUsuario) ");
            $result = mysqli_fetch_array($query);
            if ($result > 0){
                $alert = '<div class="alert alert-danger" role="alert">El Correo o el Usuario ya existe.
              </div>';
            }else{
                if(empty($_POST[$pass])){
                    $sql_update=mysqli_query($conection,"UPDATE usuario set nombre='$nombre', apellido = '$apellido', correo = '$email', usuario = '$user', rol = '$rol' WHERE idUsuario = $idUsuario");
                }else{
                    $sql_update=mysqli_query($conection,"UPDATE usuario set nombre='$nombre', apellido = '$apellido', correo = '$email', usuario = '$user', pass='$pass', rol = '$rol' WHERE idUsuario = $idUsuario");
                }
               
                if($sql_update){
                    $alert = '<div class="alert alert-success" role="alert">
                    Usuario actualizado correctamente.
                  </div>';
                }else{
                    $alert = '<div class="alert alert-danger" role="alert">ERROR al actualizar el usuario.
                  </div>';
                }
            }
        }
    }
    //mostrar datos
    if(empty($_GET['id'])){
        header('Location: lista_usuario.php');
    }
    $iduser = $_GET['id'];
    $sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.apellido, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario= $iduser");
    $result_sql = mysqli_num_rows($sql);
    if($result_sql == 0){
        header('location:lista_usuario.php');

    }else{
        $option='';
        while ($data = mysqli_fetch_array($sql)) {
            $iduser = $data['idusuario'];
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $correo = $data['correo'];
            $usuario = $data['usuario'];
            $idrol = $data['idrol'];
            $rol = $data['rol'];

            if($idrol == 1){
                $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
            }elseif($idrol == 2){
                $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
            }elseif($idrol == 3){
                $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
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
	<title>Editar Usuarios</title>
</head>
<body>
	<?php include "./includes/header.php"; ?>
	<div class="container mt-3" > 
        <section id="container">
		
            <div class="container">
                <h1>Editar Usuarios</h1>
                <hr>
                <div class="alert">
                    <?php echo isset($alert) ? $alert : ""; ?>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                    <label for="nombre">Nombre</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-user"></i></div>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Pablo" value="<?php echo $nombre; ?>">
                    </div>

                    <label for="apellido">Apellido</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-user"></i></div>
                        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Cortéz" value="<?php echo $apellido; ?>">
                    </div>

                    <label for="correo">Correo Electrónico</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        <input type="email" name="correo" class="form-control" id="correo" placeholder="nombre@midominio.com" value="<?php echo $correo; ?>">
                    </div>

                    <label for="usuario">Usuario</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de Usuario" value="<?php echo $usuario; ?>">
                    </div>

                    <label for="pass">Contraseña</label>
                    <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="contraseña">
                    </div>

                    <label for="rol">Tipo de Usuario</label>
                    <?php 
                        $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                        $result_rol = mysqli_num_rows($query_rol);                  
                    ?>
                    <div class="mb-3">
                        <div class="input-group is-invalid">
                                <label class="input-group-text" for="validatedInputGroupSelect"><i class="fas fa-user-tag"></i></label>
                            <select class="form-select notItemOne" name="rol" id="rol">
                                <?php 
                                    echo $option;
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
                        <button type="submit" class="btn btn-outline-success">Editar Usuario</button>
                    </div>
                    
                </form>
            </div>
        </section>
    </div>
	<?php include "./includes/footer.php" ?>
</body>
</html>