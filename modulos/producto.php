<?php 
	$product = new producto();
	if(isset($_POST['agregar'])){
		$nom_imagen="";
		$marca=$_POST['marca'];
		$query="select marca from marca where(id_marca='$marca')";
		$resultado = mysqli_query($conex,$query);
		$aux = mysqli_fetch_array($resultado);
		$marca = $aux[0];//obtengo el nombre de la marca para posicionar imagen en carpeta perteneciente
		$carpeta = "modulos/source/".$marca;
		$random = rand(0,1000);
		//alert($random);
		//alert($carpeta);
		if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$nom_imagen = $_POST['nombre_producto'];
			//alert($nom_imagen);
			$nom_imagen.=$random.".png";
			//alert($nom_imagen);
			$carpeta = $carpeta."/".$nom_imagen;
			//alert($carpeta);
			if(!empty($_FILES)){
				move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta);
			}
			
		}
		$product->agregar_producto($_POST['modelo'],$_POST['nombre_producto'],$_POST['marca'],$_POST['gama'],$_POST['latex'],$_POST['color'],$_POST['talla'],$carpeta,$_POST['precio_uni'],$_POST['cantidad'],$_POST['sub_total']);
		redit("?p=alta_producto");
	}
	if(isset($_POST['cancelar'])){
		$product->vaciar();
		echo $product->obtener_productos();
		/*echo $html;*/
	}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>producto</title>
</head>
<body style="background-color: #18171C">
	<div style="margin-top: 20px">
<form action="" method="POST" enctype="multipart/form-data">
	<table align="center" width="75%" style="text-align: center">
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
					MODELO
				</div>
			</td>
			<td>
				<div>
					<input class="form-control form-control-sm" type="text" placeholder="MODELO DEL PRODUCTO" name="modelo" required>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
					NOMBRE DEL PRODUCTO
				</div>
			</td>
			<td>
				<div>
					<input class="form-control form-control-sm" type="text" placeholder="NOMBRE DEL PRODUCTO" name="nombre_producto" required>	
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				MARCA
				</div>
			</td>
			<td>
				<div>
					<select class="custom-select custom-select-sm" name="marca">
					 <?php 
					 	$query="select * from marca";
					 	$resultado = mysqli_query($conex,$query);
					 	while ($aux=mysqli_fetch_array($resultado)) {
					 		?>
					 		<option value="<?=$aux[0]?>"><?=$aux[1]?></option>
					 		<?php
					 	}
					  ?>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				GAMA
				</div>
			</td>
			<td>
				<div>
					<select class="custom-select custom-select-sm" name="gama">
						<?php 
					 	$query="select * from gama";
					 	$resultado = mysqli_query($conex,$query);
					 	while ($aux=mysqli_fetch_array($resultado)) {
					 		?>
					 		<option value="<?=$aux[0]?>"><?=$aux[1]?></option>
					 		<?php
					 	}
					  ?>
					</select>	
				</div>
			</td>
			
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				LATEX
				</div>
			</td>
			<td>
				<div>
					<select class="custom-select custom-select-sm" name="latex">
					  <?php 
					 	$query="select * from latex";
					 	$resultado = mysqli_query($conex,$query);
					 	while ($aux=mysqli_fetch_array($resultado)) {
					 		?>
					 		<option value="<?=$aux[0]?>"><?=$aux[1]?></option>
					 		<?php
					 	}
					  ?>
					</select>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				COLOR/ES
				</div>
			</td>
			<td>
				<div>
					<select class="custom-select custom-select-sm" name="color">
					  <?php 
					 	$query="select color from color";
					 	$resultado = mysqli_query($conex,$query);
					 	while ($aux=mysqli_fetch_array($resultado)) {
					 		?>
					 		<option value="<?=$aux[0]?>"><?=$aux[0]?></option>
					 		<?php
					 	}
					  ?>
					</select>
					<!--<input class="form-control form-control-sm" type="text" id="c_color" name="color" required>	-->
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				TALLA
				</div>
			</td>
			<td>
				<div>
					<select class="custom-select custom-select-sm" name="talla">
					  <?php 
					 	$query="select * from talla";
					 	$resultado = mysqli_query($conex,$query);
					 	while ($aux=mysqli_fetch_array($resultado)) {
					 		?>
					 		<option value="<?=$aux[0]?>"><?=$aux[1]?></option>
					 		<?php
					 	}
					  ?>
					</select>	
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				IMAGEN:
				</div>
			</td>
			<td>
				<div class="custom-file">
				  <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagen" required>
				  <label class="custom-file-label" for="customFileLang">Seleccionar imagen</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				PRECIO p/u
				</div>
			</td>
			<td>
				<div class="input-group mb-3" style="margin-top: 15px">
					<div class="input-group-prepend">
				 	 <span class="input-group-text">$</span>
					 </div>
					<input class="form-control" type="number" name="precio_uni" id="precio_uni" onkeyup="habilitar()" required value="0">	
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				CANTIDAD
				</div>
			</td>
			<td>
				<div>
					<input class="form-control form-control-sm" type="number" name="cantidad" id="cantidad" onkeyup ="calcular();"  value="1" name="cantidad" required min="1">	
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
					SUB-TOTAL:
				</div>
			</td>
			<td>
				<div class="input-group mb-3" style="margin-top: 15px">
				 <div class="input-group-prepend">
				 	 <span class="input-group-text">$</span>
				 </div>
				 <input type="text" class="form-control"  name="sub_total"  id="sub_total" value="0" required>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<div>
					<button type="submit" class="btn btn-success" name="agregar" style="width: 100%; font-family: Times New Roman;" onclick="sumar();">AGREGAR</button>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<div>
					<button type="reset" class="btn btn-danger" name="cancelar" style="width: 100%; font-family: Times New Roman;">CANCELAR</button>
				</div>
			</td>
		</tr>

	</table>
</form>
	</div>
	<center>
	<form action="" method="POST">
	<div style="text-align: center; width: 75%; margin-top: 10px">
		
		<button type="submit" class="btn btn-light" name="borrar" style="width: 100%; font-family: Times New Roman;">BORRAR PRODUCTO YA AGREGADO</button>
	</div>
	<div style="text-align: center; width: 75%; margin-top: 3px">
		<button type="submit" class="btn btn-warning" name="bt_cancelar" style="width: 100%; font-family: Times New Roman;">VACIAR CARRO DE COMPRAS</button>
	</div>
	</form>
	</center>
<div>
	<?=$product->obtener_productos();?>
</div>

<?php 
	if(isset($_POST['borrar'])){
	$html='';
	$html='
	<form action="" method="POST">
		<table align="center" width="75%" style="text-align: center">
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
					MODELO
				</div>
			</td>
			<td>
				<div>
					<input class="form-control form-control-sm" type="text" placeholder="MODELO DEL PRODUCTO" name="modelo">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-monospace" style="background-color: #803F53; border-radius: 2px; font-size: 20px; color:#FFFBFB">
				COLOR/ES
				</div>
			</td>
			<td>
				<div>
					<input class="form-control form-control-sm" type="text" id="c_color" name="color">	
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div>
					<button type="submit" class="btn btn-warning" name="bt_borrar" style="width: 100%; font-family: Times New Roman;">BORRAR</button>
				</div>
			</td>
		</tr>
		
		</table>
	</form>';
	echo $html;
	}
	if(isset($_POST['bt_borrar'])){
			if($product->eliminar_producto($_POST['modelo'],$_POST['color'])){
				alert('Eliminado con exito');
				redit("?p=alta_producto");
			}else{
				alert('modelo y/o color incorrecto');	
				redit("?p=alta_producto");		
			}
		}
	if(isset($_POST['bt_cancelar'])){
		$product->vaciar();
		redit("?p=alta_producto");
	}
 ?>
</body>
</html>