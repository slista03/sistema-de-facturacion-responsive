<?php
	include "../conexion/conexion.php";

	if(!empty($_POST)){
		if($_POST['idusuario'] == 1){
			header('location: lista_usuario.php');
			exit;
		}
		$idusuario=$_POST['idusuario'];
		//$query_delete= mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");
		$query_delete = mysqli_query($conection,"UPDATE `usuario` SET `estatus` = '0' WHERE `usuario`.`idusuario` = $idusuario");
		if($query_delete){
			header('location: lista_usuario.php');
		}else{
			$alert = '<div class="alert alert-danger" role="alert">ERROR al eliminar el usuario.
				  </div>';
		}
	}

	if(empty($_REQUEST['id']) || ($_REQUEST['id'] == 1) ){
		header('location: lista_usuario.php');
	}else{
		$idusuario =$_REQUEST['id'];
		$query = mysqli_query($conection, "SELECT u.nombre, u.apellido, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario = $idusuario");
		$result = mysqli_num_rows($query);
		if ($result > 0){
			while($data = mysqli_fetch_array($query)){
				$nombre= $data['nombre'];
				$apellido= $data['apellido'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];
			}
		}else{
			header('location: lista_usuario.php');
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "./includes/scripts.php";?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include "./includes/header.php"; ?>
	<section id="container ">
		<h1>Lista de Usuarios</h1>
		<hr>
		<div class="container btn-center superior">
			<?php echo $alert; ?>
			<h2>¿Está seguro de que quiere eliminar el siguiente usuario?</h2>
			<p>Nombre: <b><span> <?php echo $nombre. " ". $apellido; ?> </span> </b> </p>
			<p>Usuario: <b> <span> <?php echo $usuario; ?></span> </b> </p>
			<p>Rol: <b> <?php echo $rol; ?> </span> </b><span>  </p>
			<form method="post" action="">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario;?>">
				<a href="lista_usuario.php" class="btn btn-outline-danger ml-4">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn btn-outline-primary">
			</form>
		</div>
	</section>

	<?php include "./includes/footer.php" ?>
</body>
</html>