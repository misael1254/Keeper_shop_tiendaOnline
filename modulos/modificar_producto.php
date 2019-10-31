<?php 
$accion;
	
	if(isset($_POST['eliminar'])){
		$modelo = $_POST['modelo'];
		$query="select src from es_color where (modelo = '$modelo')";
		$resultado = mysqli_query($conex,$query);
		$row=mysqli_fetch_array($resultado);
		$src = $row[0];
		$query = "delete from producto where(modelo = '$modelo')";
		if(mysqli_query($conex,$query)){
			unlink($src);
			alert("producto ELIMINADO");
		}

	}

	if(isset($_POST['proveedores'])){
		$modelo = $_POST['modelo'];
		$link = "?p=lista_proveedores_producto&modelo=".$modelo;
		redit($link);
	}

	if(isset($_POST['actualizar'])){
		$nombre_producto= $_POST['nombre_producto'];
		$existencia = $_POST['existencia'];
		$precio = $_POST['precio'];
		$marca=$_POST['marca'];
		$gama=$_POST['gama'];
		$latex=$_POST['latex'];
		$talla=$_POST['talla'];
		$modelo = $_POST['modelo'];


		$aux_marca= explode("_", $marca);
		$marca=$aux_marca[0];

		$carpeta = "modulos/source/".$aux_marca[1];
		$random = rand(0,1000);
		if(isset($_FILES['imagen']['tmp_name'])){
			if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
				$nom_imagen = $nombre_producto;
				//alert($nom_imagen);
				$nom_imagen.=$random.".png";
				//alert($nom_imagen);
				$carpeta = $carpeta."/".$nom_imagen;
				//alert($carpeta);
				if(!empty($_FILES)){
					move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta);
				}

				$query="select src from es_color where(modelo='$modelo')";
				$resultado=mysqli_query($conex,$query);
				$row=mysqli_fetch_array($resultado);
				$src = $row['src'];
				unlink($src);

				$query="update es_color set src='$carpeta' where(modelo='$modelo')";
				mysqli_query($conex,$query);
			}else{
				$query="select id_marca,nombre_producto from producto where(modelo ='$modelo')";
				$resultado = mysqli_query($conex,$query);
				$row = mysqli_fetch_array($resultado);
				if($row['id_marca']!= $marca){
					$nom_imagen = $nombre_producto;
					$nom_imagen.=$random.".png";
					$carpeta = $carpeta."/".$nom_imagen; //destino

					$query="select src from es_color where(modelo='$modelo')";
					$resultado=mysqli_query($conex,$query);
					$row=mysqli_fetch_array($resultado);
					$src = $row['src']; //ubicación actual

					$query="update es_color set src='$carpeta' where(modelo='$modelo')";
					mysqli_query($conex,$query);
					rename($src, $carpeta);
				}
				//alert("no se subio ningun archivo");
			}
		}


		$query="select existencia from es_color where(modelo='$modelo')";
		$resultado=mysqli_query($conex,$query);
		$row=mysqli_fetch_array($resultado);
		$aux_existencia_escolor = $row['existencia'];
		$query="update es_color set existencia='$existencia' where(modelo = '$modelo');";
		mysqli_query($conex,$query);

		$query="select existencia from producto where(modelo='$modelo')";
		$resultado=mysqli_query($conex,$query);
		$row=mysqli_fetch_array($resultado);
		$aux_existencia = $row['existencia'];
		if($aux_existencia != $existencia){
			if($existencia > $aux_existencia_escolor){
				$existencia =  $existencia - $aux_existencia_escolor;
				$existencia = $existencia + $aux_existencia;
			}
			else{
				$existencia = $aux_existencia_escolor - $existencia;
				$existencia = $aux_existencia - $existencia;
			}
			$query="update producto set nombre_producto='$nombre_producto',existencia='$existencia',precio='$precio',id_marca='$marca',id_talla='$talla',id_gama='$gama',id_latex='$latex' where(modelo = '$modelo');";
		}else{
			$query="update producto set nombre_producto='$nombre_producto',precio='$precio',id_marca='$marca',id_talla='$talla',id_gama='$gama',id_latex='$latex' where(modelo = '$modelo');";
		}
		mysqli_query($conex,$query);

		alert("DATOS ACTUALIZADOS CORRECTAMENTE");
		//$src = $_POST['src'];
	}
	if(isset($_GET['accion'])){
		$accion=$_GET['accion'];
	}
	?>
		<div align="center">
			<table>
				<tr>
					<td>
						<div style="padding: 5px; margin:5px; text-align: center">
							<font color="#FFFFFF">
								SELECCIONE MODELO DE producto
								<br>A MODIFICAR

							</font>
						</div>
					</td>
					<td>
						<div>
							<select class="form-control" id="" name="modelo_producto" required="Y" onchange="CargarProducto(this.value,<?=$accion?>)">
								<option disabled selected>SELECCIONAR MODELO DE producto</option>
								<?php 
									$query = "select modelo from producto;";
									$resultado = mysqli_query($conex,$query);
									while($row=mysqli_fetch_array($resultado)){
										?>
											<option value="<?=$row['modelo']?>"><?=$row['modelo']?></option>
										<?php
									}
								 ?>
							</select>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div id="divsito" style="color: white" align="center">
			<table>
				
			</table>
		</div>
	<?php

?>


