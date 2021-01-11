<nav class="navbar navbar-expand-lg" class="navbar navbar-light" style="background-color: #e3f2fd;">
  	<div class="container-fluid">
    	<a class="navbar-brand" href="#">AlienRoom</a>
    	<button class="navbar-toggler" style="border-color: black;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      		<span><i class="fas fa-bars"></i></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
      		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        		<li class="nav-item">
					<a class="nav-link" href="index.php">Inicio</a>
				</li>
				<?php
					//si el rol es de un administrador se mostrara esta opcion de usuarios
					if($_SESSION['rol'] == 1){}
				?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Usuarios</a>
						<ul class="dropdown-menu" aria-labelledby="dropdown07XL">
							<a class="dropdown-item" href="./registro_usuario.php">Nuevo Usuario</a>
							<li><hr class="dropdown-divider"></li>
							<a class="dropdown-item" href="./lista_usuario.php">Lista de Usuarios</a>
						</ul>
					</li>
				<?php
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Clientes</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown07XL">
							<a href="./registro_usuario.php" class="dropdown-item">Nuevo Usuario</a>
							<li><hr class="dropdown-divider"></li>
							<a href="./lista_usuario.php" class="dropdown-item">Lista de Usuarios</a>
						</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Proveedores</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown07XL">
						<li><a href="#" class="dropdown-item">Nuevo Proveedor</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Lista de Proveedores</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Productos</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown07XL">
						<li><a href="#" class="dropdown-item">Nuevo Producto</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Lista de Productos</a></li>
					
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Facturas</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					
						<li><a href="#" class="dropdown-item">Nuevo Factura</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Facturas</a></li>
					
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"  href="#" data-bs-toggle="dropdown">Contizaciones</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					
						<li><a class="dropdown-item" href="#">Nueva Cotización</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#">Contizaciones</a></li>
					
					</ul>
				</li>
			</ul>
    	</div>
  	</div>
</nav>