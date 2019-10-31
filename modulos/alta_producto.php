<?php 
	include "clase_producto.php";
	$produ = new producto();
	$variable=0;
	$produ->actualizar_carro();
	$carro = $produ->get_carro();
	$check = 'checked';
	if($carro == 0){
		alert('no hay nada en el carro');
	}
	else{
		foreach ($carro as $key) {
			$variable = $variable + $key['subtotal'];
		}
	}
	if(isset($_POST['terminar'])){
		//echo $produ->obtener_productos();
		//alert(''.$_POST['folio_compra'].''.$_POST['RFC'].''.$_POST['tipo_pago'].''.$_POST['total']);
		$produ->insertar_compra($_POST['RFC'],$_POST['tipo_pago'],$_POST['total']);
		//$produ->limpiar_carro();
	}
	if(!isset($_SESSION['id'])){
	alert('NO TIENE SESIÓN INICIADA');
	redit("?p=login");
}
else{
	$id_usuario = $_SESSION['id'];
	//alert($id_usuario);
	$resultado = mysqli_query($conex,"select tipo_usu from usuario where(nombre_usu = '$id_usuario')");
	$rows = mysqli_fetch_array($resultado);
	$tipo_usu = $rows['tipo_usu'];
	//alert($tipo_usu);
	if($tipo_usu != 1){
		redit("?p=inicio");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body style="background-color: #18171C">
<div>
<form action="" method="POST">
	<table width="50%; " align="center">
		<tr>
			<td >
				<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px">
				<label>NOMBRE DEL PROVEEDOR</label>
				</div>
			</td>
			<td>
				<div class="input-group mb-3" style="margin-top: 15px">
					<select class="form-control" name="RFC" required>
						<?php 
							$query="select rfc,nombre_proveedor from proveedor";
							$resultado = mysqli_query($conex,$query);
							if(mysqli_num_rows($resultado)>0){
								while ($rows=mysqli_fetch_array($resultado)) {
									?>
									<option value="<?=$rows[0]?>"><?=$rows[1]?></option>
									<?php
								}
							}
						 ?>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<div class="badge badge-primary text-wrap" style="width:100%; font-size: 15px">
				<label style="border-radius: 5">TIPO DE PAGO</label>
				</div>
			</td> 
			<td>
				<input type="radio" value="TARJETA_CREDITO" name="tipo_pago" style="color: #FFFFFF" checked>
				<font style="color: #FFFFFF">TARJETA DE CREDITO</font> 
			</td>
		</tr>
		<tr>
			<td>
				<input type="radio" value="TARJETA_DEBITO" name="tipo_pago" > 
				<font style="color: #FFFFFF">TARJETA DE DEBITO</font> 
			</td>
		</tr>
		<tr>
			<td >
				<div class="badge badge-primary text-wrap" style="width:100%; font-size: 15px">
				<label>MONTO TOTAL</label>
				</div>
			</td>
			<td>
				<div class="input-group mb-3" style="margin-top: 15px">
				  <div class="input-group-prepend">
				    <span class="input-group-text">$</span>
				  </div>
				  <input type="text" class="form-control" id="id_total" name="total" value="<?php echo $variable;?>" required >
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" class="btn btn-danger " style="width: 100%" name="terminar">TERMINAR COMPRA</button>
			</td>
		</tr>
	</table>
</form>
</div>
	<div class="cuerpo">
		<?php 
			if(file_exists("modulos/producto.php")){
				include "producto.php";
			}
			else{
				include "error.php";
			}
		 ?>
	</div>
</body>
</html>