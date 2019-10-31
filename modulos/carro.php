<?php 
	include "clase_carrito.php";
	$carrito = new carrito();
	$total= 0;
	echo $carrito->get_car();
	if(isset($_POST['act'])){
		$carrito->modify($_POST['oculto'],$_POST['cantidad']);
		redit("?p=carro");
	}
	if(isset($_POST['eli'])){
		$carrito->delete_element($_POST['oculto']);
		redit("?p=carro");
	}
	if(isset($_SESSION['car'])){
		$total=$carrito->get_total();
		?>
		<br>
		<div style='width: 75%; margin: 0 auto' align="center">
			<span class="btn btn-info">
				TOTAL A PAGAR
				<i class="fas fa-money-bill fa-spin"></i>
				<input class="btn btn-info" type="text" size="2%" name="TOTAL" value="<?=$total?>"  disabled>
				<i class="fas fa-money-bill fa-spin"></i>
			</span>
			
		</div>
		<br>
		<div style='width: 75%; margin: 0 auto' align="center">
			<a href="?p=datos_cliente&act=0">
			<button class="btn btn-success btn-lg" name="terminar_compra" type="submit">
				<span>
					<i class="fas fa-handshake"></i>
						TERMINAR COMPRA
					<i class="fas fa-handshake"></i>
				</span>
			</button>
			</a>
		</div>
		<?php	
	}else{
		?>
		<div>
			<a href="?p=vista_producto">
				<img src="img/nada_carro.jpg" alt="#" width="100%">
			</a>
		</div>
		<?php	
	}
	
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<div style='background: #1106F5; width: 75%; margin: 0 auto'>
	<table align="center" style="width: 100%" bgcolor="white">
		<tr>
			<td width="50%" style="background-image:url(img/fondo.png); " rowspan="5">
				<div style="width: 50%; background:red; margin: 0 auto">
					<img src="modulos/source/RINAT/UNO PREMIER NG B NAR494.png" style="width: 100%">
				</div>
			</td>
			<td >
				<div align="right">
					<strong>NOMBRE DEL PRODUCTO:</strong>
				</div>
			</td>
			<td>
				<span>
					<i class="fas fa-futbol"></i>
					
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<div align="right">
					<strong>PRECIO:</strong>
				</div>
			</td>
			<td>
				<div>
					<span>
					<i class="fas fa-tags"></i>

					</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div align="right">
					<strong>CANTIDAD DISPONIBLE:</strong>
				</div>
			</td>
			<td>
				<div>
					<span>
					<i class="fas fa-smile"></i>

					</span>
				</div>
			</td>
		</tr>
		<form action="" method="POST">
		<tr>
			<td>
				<div align="right">
					<span>
						<strong>CANTIDAD A PEDIR:</strong>
					</span>
				</div>
			</td>
			<td>
				<div>
					<span>
		 			<button type="button" class="btn_a" onclick="act('sumar',)">
		 				<i class="fas fa-caret-square-up"></i>
		 			</button>
		 			<input type="text" name="cantidad" id="can_id" value="1" min="1" style="width: 20%; text-align: center; margin:none;" onkeypress="return validar_num(event)" onblur="act('sumar',)">
		 			<input type="hidden" value="estoy oculto" name="oculto">
		 			<button type="button" class="btn_d" onclick="act('restar',)">
		 				<i class="fas fa-caret-square-down"></i>
		 			</button>
	 			</span>
				</div>
			</td>
		</tr>
		<tr>
			<td width="25%">
				<div>
					<button type="submit" name="act" class="btn btn-warning" style="width: 100%">ACTUALIZAR</button>
				</div>
			</td>
			<td width="90%">
				<div>
					<button type="submit" name="eli" class="btn btn-danger" style="width: 100%">ELIMINAR</button>
				</div>
			</td>
		</tr>
	</form>
	</table>
	</div>
</body>
</html>-->
