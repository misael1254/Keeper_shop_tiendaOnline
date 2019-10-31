<?php 
include "clase_carrito.php";
$carrito = new carrito();
$modelo = $_GET['modelo'];
$consulta = "select producto.modelo,producto.nombre_producto,es_color.existencia,es_color.src,precio,color.color,marca.marca,talla.talla,gama.gama,latex.latex
	from PRODUCTO
	inner join es_color on(producto.modelo = es_color.modelo and producto.modelo = '$modelo')
	inner join color on (es_color.id_color = color.id_color)
	inner join marca on (producto.id_marca= marca.id_marca)
	inner join talla on (producto.id_talla = talla.id_talla)
	inner join gama on (producto.id_gama = gama.id_gama)
	inner join latex on (producto.id_latex = latex.id_latex)";
$resultado = mysqli_query($conex,$consulta) or die("NADA");
$rows=@mysqli_fetch_array($resultado);

if(isset($_POST['add'])){
	/*if(!isset($_SESSION['id'])){
		redit("?p=login");
	}else{
		alert($rows['modelo'].','.$_POST['cantidad']);
		$carrito->add_product($rows['modelo'],$_POST['cantidad']);
	}*/
	
	$carrito->add_product($rows['modelo'],$_POST['cantidad']);
	alert("PRODUCTO AGREGADO");
}

	?>
	<div class="caja1">
		
	 <table class="tabla_especifica">
	 	<tr class="div_imagen_producto" style="background-image:url(img/fondo_pasto.jpg);">
	 		<td>
	 			<div class="div_imagen_producto">
	 				<img src="<?=$rows['src']?>" alt="IMAGEN" class="img-fluid">
	 			</div>
	 		</td>
	 	</tr>
	 </table>
	</div>

	<div class="caja2">
	 <table class="tabla_especificaciones" bgcolor="white">
	 	<tr>	
	 		<td class="titulo_producto" style="height: 100%" colspan="2">
	 			<div align="center">
	 			<strong style="font-size: 30px; color: #040404">
	 				<?=$rows['nombre_producto']?>
	 			</strong>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						MODELO:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
						<?=$rows['modelo']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						MARCA:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
						<?=$rows['marca']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						GAMA:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
							<?=$rows['gama']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						LATEX:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
							<?=$rows['latex']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						TALLA:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
							<?=$rows['talla']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						COLOR:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
							<?=$rows['color']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						DISPonIBLES:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td bgcolor="white">
	 			<div>
	 				<i class="far fa-hand-point-right"></i>
							<?=$rows['existencia']?>
	 				<i class="far fa-hand-point-left"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td width="10%">
	 			<div align="center">
	 				<span>
	 					<strong style="font-size: 20px;">
	 						PRECIO:   
	 					</strong>
	 				</span>
	 			</div>
	 		</td>
	 		<td>
	 			<div>
	 				<i class="fas fa-tags"></i>
						<strong style="color: #20722E"> <?=$rows['precio']?> MX </strong>	
	 				<i class="fas fa-tags"></i>
	 			</div>
	 		</td>
	 	</tr>
	 	<tr>
	 		<form action="" method="POST">
	 		<td colspan="2">
	 			<div style="width: 25%; display: inline-block;" align="center">
	 			<span>
		 			<button type="button" class="btn_a" onclick="act('sumar',<?=$rows['existencia']?>)">
		 				<i class="fas fa-caret-square-up"></i>
		 			</button>
		 			<input type="text" name="cantidad" id="can_id" value="1" min="1" style="width: 20%; text-align: center; margin:none;" onkeypress="return validar_num(event)" onblur="act('sumar',<?=$rows['existencia']?>)"> <input type="hidden" value="1">
		 			<button type="button" class="btn_d" onclick="act('restar',<?=$rows['existencia']?>)">
		 				<i class="fas fa-caret-square-down"></i>
		 			</button>
	 			</span>
	 			</div>
	 			<div style="width: 73%; display: inline-block;" align="center">
	 				<span>
	 					<strong style="font-size: 22px;">
	 						AGREGAR AL CARRO  
	 					</strong>
	 					<button class="btn btn-secondary float-right" type="submit" name="add">
							<i class="fas fa-cart-plus"></i>
						</button>
	 				</span>
	 			</div>
	 		</td>
	 		</form>
	 	</tr>
	 </table>
	</div>
	<?php

?>