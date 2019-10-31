<?php 
include "clase_carrito.php";
$carrito = new carrito();
$index=$_GET['index'];
if(isset($_POST['add'])){
	$carrito->add_product($_POST['modelo'],$_POST['cantidad']);
}

if(isset($_POST['buscar'])){
	if(isset($_POST['marca'])){
		$marca = $_POST['marca'];
		if($marca==0){
		$index=1;
		}
		else{
		$sql = mysqli_query($conex,"select nombre_producto,producto.modelo,es_color.existencia,precio,color,src from producto 
		inner join es_color on(producto.modelo = es_color.modelo and  es_color.existencia <> 0 and producto.id_marca='$marca')
		inner join color on (es_color.id_color = color.id_color)") or die("ERROR QUERY");
		$index=2;
		}
	}
	
	
	
}

if(isset($_GET['index'])){
	if($index==1){
		$sql = mysqli_query($conex,"select nombre_producto,producto.modelo,es_color.existencia,precio,color,src from producto 
		inner join es_color on(producto.modelo = es_color.modelo and  es_color.existencia <> 0 )
		inner join color on (es_color.id_color = color.id_color)") or die("ERROR QUERY");
	}

	?>
	<div style="background-color: #FFFF; padding: 3px; margin:3px;">
		<table>
			<form action="" method="POST">
				<tr>
					<td>
						<select name="marca" class="form-control">
							<option selected disabled>POR MARCA</option>
							<option value="0">TODOS</option>
							<?php 
							$query="select * from marca";
							$resultado = mysqli_query($conex,$query);
							while ($row=mysqli_fetch_array($resultado)) {
								?>
								<option value="<?=$row[0]?>"><?=$row[1]?></option>
								<?php
							}
							?>
						</select>
					</td>
					<td>
						<button type="submit" name="buscar" class="btn btn-dark">
							BUSCAR
						</button>
					</td>
				</tr>
			</form>
		</table>
	</div>
	<?php
	while($rows=mysqli_fetch_array($sql))
	{
		?>
			<table class="tabla_producto">
				<tr class="fila_nom_pro">
					<td style="width: 100%">
						<div class="titulo_producto" align="center">
							<?=$rows['nombre_producto']?>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width: 100%">
						<div class="div_imagen_producto">
							<a href="?p=producto_especifico&modelo=<?=$rows['modelo']?>" style="text-decoration: none">
							 <img class="imagen_producto" src="<?=$rows['src']?>" alt="">
							 </a>
						</div>
					</td>
				</tr>
				<tr class="precio">
					<td style="width: 100%">
						<span>
						<i class="fas fa-futbol fa-spin"></i>
						<strong>EXISTENCIA: </strong> <?=$rows['existencia']?>
						</span>
						<br>
						<span>
							<i class="fas fa-tags"></i>
							<strong>PRECIO P/U: </strong> <?=$rows['precio']?> <?=$divisa?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						
					</td>
				</tr>
				<tr>
					<td>
						<form action="" method="POST">
							<span>
								<input type="number" name="cantidad" value="1" min="1" max="<?=$rows['existencia']?>" style="width: 75%; text-align: center;" > <input type="hidden" name="modelo" value="<?=$rows['modelo']?>">
								<button class="btn btn-secondary float-right" type="input" name="add">
									<i class="fas fa-cart-plus"></i>
								</button>
							</span>
						</form>
					</td>
				</tr>
			</table>
		<?php
	}
}






?>