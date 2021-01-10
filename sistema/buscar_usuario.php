<?php
    include "../conexion/conexion.php";
       
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "./includes/scripts.php";?>
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "./includes/header.php"; ?>
    <div class="container mt-3">
        <section id="container ">
            <?php

                $busqueda = strtolower($_REQUEST['busqueda']);
                if(empty($busqueda)){
                    header("location: lista_usuario.php");
                }

            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h1>Lista de Usuarios</h1>
                    </div>
                    <div class="col-sm-4 ">
                        <a href="./registro_usuario.php">
                            <button href="./registro_usuario.php" role="button"  class="btn btn-outline-primary mt-1 ">Crear Usuario</button>
                        </a>
                    </div>
                    <div class="col-sm-4 ">
                        <form class="d-flex" action="buscar_usuario.php" method="get">
                            <input class="form-control me-2" name="busqueda"id='busqueda' type="search" placeholder="Buscar" value="<?php echo $busqueda; ?>" aria-label="">
                            <button class="btn btn-outline-primary" type="submit" value="Buscar" >Buscar</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="table-responsive-xl">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        <?php
                        //paginador
                        $rol="";
                        if($busqueda=='administrador'){
                            $rol="OR rol LIKE '%1%'";
                        }else if($busqueda=='supervisor'){
                            $rol="OR rol LIKE '%2%'";
                        }else if($busqueda=='vendedor'){
                            $rol="OR rol LIKE '%3%'";
                        }

                        $sql_register = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE (idusuario LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' $rol) AND estatus = 1");
                        $result_register = mysqli_fetch_array($sql_register);
                        $total_registro = $result_register['total_registro'];

                        $por_pagina = 5;
                        
                        if (empty($_GET['pagina'])){
                            $pagina = 1;
                        }else{
                            $pagina = $_GET['pagina'];
                        }
                        $desde = ($pagina - 1) * $por_pagina;
                        $total_paginas = ceil($total_registro / $por_pagina);
                        
                        
                        
                        
                        $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.apellido, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE (u.idusuario LIKE '%$busqueda%' OR u.nombre LIKE '%$busqueda%' OR u.apellido LIKE '%$busqueda%' OR u.correo LIKE '%$busqueda%' OR u.usuario LIKE '%$busqueda%' OR r.rol LIKE '%$busqueda%') AND estatus = 1 ORDER BY idusuario ASC LIMIT $desde,$por_pagina");
                        $result = mysqli_num_rows($query);
                        if($result > 0){

                            while ($data =mysqli_fetch_array($query)) {
                            ?>

                            <tr>
                                <td><?php echo $data['idusuario']; ?></td>
                                <td><?php echo $data['nombre']; ?></td>
                                <td><?php echo $data['apellido']; ?></td>
                                <td><?php echo $data['correo']; ?></td>
                                <td><?php echo $data['usuario']; ?></td>
                                <td><?php echo $data['rol']; ?></td>
                                <td>
                                    <a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="link_edit">Editar</a>
                                    
                                    <?php
                                        if($data['idusuario'] != 1){
                                    ?> 
                                        |
                                        <a href="eliminar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="link_delete">Eliminar</a>
                                    <?php
                                        }

                                    ?>
                                
                                    
                                </td>
                            </tr>

                            <?php  
                            }
                        }
                        ?>
                    </table>
                    <?php 
                        if($pagina > $total_paginas){
                            header('location:lista_usuario.php?pagina=1');
                        }else if($pagina < 1){
                            header('location:lista_usuario.php?pagina=1');
                        }
                        if($total_paginas>1){
                    ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php
                                    if($pagina != 1){
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?php echo 1; ?>">|<</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?php echo $pagina-1; ?>"  ><<</a>
                                </li>
                                <?php 
                                    }
                                    for($i=1; $i <= $total_paginas; $i++){
                                        if($i==$pagina){
                                            echo '<li class="page-item active"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li class="page-item "><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                        
                                    }
                                    if($pagina != $total_paginas){
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?php echo $pagina+1; ?>">>></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?php echo $total_paginas; ?>">>|</a>
                                </li>
                                    <?php } ?>
                            </ul>
                        </nav>
                    <?php }?>
                </div>
            </div>        
        </section>
    </div>
    

	<?php include "./includes/footer.php" ?>
</body>
</html>