<?php
session_start();
if(empty($_SESSION['active'])){

    header('location: ../');

}
?>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <h1>Sistema Facturación</h1>
            </div>
            <div class="col-sm">
                <div class="superior">
                    Panamá, <?php echo fechaC();?>
                    <span>|</span>
                    <span><?php echo $_SESSION['user']; ?></span>
                    <img class="photouser" src="img/user.png" alt="Usuario">
                    <a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php include "nav.php"?>
</header>