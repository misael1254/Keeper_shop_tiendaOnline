<?php 
	include "config/config.php";
	include "config/funciones.php";
	
	if(!isset($p)){
		$p="inicio";
	}
	else{
		$p=$p;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WORLDKEEPER</title>
	<link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" href="bootstrap/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/bootstrap-grid.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body class="cuerpawer">
	<div>
		<table class="tabla">
			<tr>
				<td colspan="4" class="titulo" align="CENTER">
					<div class="divsito">
						<img src="img/titulo.png" alt="WORLDKEEPER" align="CENTER" width="100%">	
					</div>
					
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<nav class="navbar navbar-expand-md navbar-dark bg-dark">
					  <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#bar-ocu" aria-controls="bar-ocu" aria-expanded="false" aria-label="Toggle navigation">
   						 <span class="navbar-toggler-icon"></span>
  					  </button>
					  <a href="?p=inicio" class="nav-brand" >
					  	<img src="img/icono.png" class="d-inline-block align-top" width="30" height="30">
					  	WORLDKEEPER
					  	<img src="img/icono.png" class="d-inline-block align-top" width="30" height="30">
					  </a>
					  <div class="collapse navbar-collapse" id="bar-ocu">
						  <div class="navbar-nav">
							<a href="?p=inicio" class="nav-item nav-link active">INICIO</a>
							<a href="?p=vista_producto&index=1" class="nav-item nav-link">PRODUCTOS</a>
							<a href="?p=carro" class="nav-item nav-link">VER CARRITO</a>
							<a href="?p=quienes_somos" class="nav-item nav-link">QUIENES SOMOS</a>
							
						  </div>
					  </div>					  
					  <div>
						 <?php 
						 	if(!isset($_SESSION['id'])){
						 		?>
						 		<a href="?p=login" class="btn btn-light">INICIAR SESIÓN/REGISTRARSE</a>
						 		<?php
						 	}
						 	else{
						 			if($_SESSION['t_u']==1){
							 			?>
								 		<a href="?p=menu" class="btn btn-info">MENU ADMI</a>
								 		<?php
						 			}
						 		?>
						 		<a href="?p=datos_cliente&act=1" class="btn btn-outline-warning">ACTUALIZAR DATOS</a>
						 		<a href="?p=salir" class="btn btn-light">CERRAR SESIÓN</a>
						 		<?php
						 	}
						  ?>
					  </div>
					</nav>
				</td>
			</tr>
		</table>
	</div>
	<div class="cuerpo">
		<table width="100%">
			<tr style="height: 100%">
				<td height="100%">
					<div>
						<?php 
							$p="modulos/".$p.".php";
							if(file_exists($p)){
								include $p;
							}
							else{
								if($p =="modulos/salir.php"){
									@session_destroy();
									redit("?p=inicio");
									//include "modulos/inicio.php";
								}
								else{
								include "modulos/error.php";
								}
								//echo "error,papi";
							}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>

<script type="text/javascript" src="fun.js"></script>
<script type="text/javascript" src="fontawesome/js/all.js"></script>
<script src="bootstrap/jquery-3.4.0.min.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/jquery.creditCardValidator.js"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
</body>
</html>