<?php 
	if(isset($_POST['modelo'])){
		$accion=$_POST['accion'];
		$disabled;
		if($accion == 0 || $accion == 2){
			$disabled = "disabled";
		}
		else{
			$disabled = "";
		}
		$modelo = $_POST['modelo'];
		$conex = new mysqli("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR ConEXIÓN Con SERVIDOR");
		
		$query = "select producto.nombre_producto,es_color.existencia,es_color.src,precio,marca.marca,talla.talla,gama.gama,latex.latex
			from producto
			inner join es_color on(producto.modelo = es_color.modelo and producto.modelo = '$modelo')
			inner join color on (es_color.id_color = color.id_color)
			inner join marca on (producto.id_marca= marca.id_marca)
			inner join talla on (producto.id_talla = talla.id_talla)
			inner join gama on (producto.id_gama = gama.id_gama)
			inner join latex on (producto.id_latex = latex.id_latex)";
		$resultado = mysqli_query($conex,$query);
		$rows = mysqli_fetch_array($resultado);
		$nombre_producto =$rows['nombre_producto'];
		$existencia = $rows['existencia'];
		$precio = $rows['precio'];
		$marca=$rows['marca'];
		$gama=$rows['gama'];
		$latex=$rows['latex'];
		$talla=$rows['talla'];
		$src = $rows['src'];
		$marcas='';
		$gamas='';
		$latexs='';
		$tallas='';
		$query = "select * from marca";
		$resultado = mysqli_query($conex,$query);
		while($rows=mysqli_fetch_array($resultado)){
			if($rows['marca']==$marca){
				$aux = '<option value="'.$rows['id_marca'].'_'.$rows['marca'].'" selected>'.$rows['marca'].'</option>';
			}else{
				$aux = '<option value="'.$rows['id_marca'].'_'.$rows['marca'].'">'.$rows['marca'].'</option>';
			}
			$marcas=$marcas.''.$aux;
		}

		$query = "select * from talla";
		$resultado = mysqli_query($conex,$query);
		while($rows=mysqli_fetch_array($resultado)){
			if($rows['talla']==$talla){
				$aux = '<option value="'.$rows['id_talla'].'" selected>'.$rows['talla'].'</option>';
			}else{
				$aux = '<option value="'.$rows['id_talla'].'">'.$rows['talla'].'</option>';
			}
			$tallas= $tallas.''.$aux;
		}

		$query = "select * from gama";
		$resultado = mysqli_query($conex,$query);
		while($rows=mysqli_fetch_array($resultado)){
			if($rows['gama']==$gama){
				$aux = '<option value="'.$rows['id_gama'].'" selected>'.$rows['gama'].'</option>';
			}else{
				$aux = '<option value="'.$rows['id_gama'].'">'.$rows['gama'].'</option>';
			}
			$gamas= $gamas.''.$aux;
		}

		$query = "select * from latex";
		$resultado = mysqli_query($conex,$query);
		while($rows=mysqli_fetch_array($resultado)){
			if($rows['latex']==$latex){
				$aux = '<option value="'.$rows['id_latex'].'" selected>'.$rows['latex'].'</option>';
			}else{
				$aux = '<option value="'.$rows['id_latex'].'">'.$rows['latex'].'</option>';
			}
			$latexs= $latexs.''.$aux;
		}
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<table>
					<tr>
						<td colspan="2">
							<div align="center">
								<img src="<?=$src?>" style="width: 50%" alt="">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							NOMBRE DEL PRODUCTO:
						</td>
						<td>
							<input class="form-control" type="text" name="nombre_producto" value="<?=$nombre_producto?>" <?=$disabled?> size="50" >
							<input type="text" name="modelo" hidden value="<?=$modelo?>">
						</td>
					</tr>
					<tr>
						<td>
							marca:
						</td>
						<td>
							<select class="form-control" name="marca" id="" style=" width: 150px" <?=$disabled?>>
								<?=$marcas?> 
							</select>
						</td>
					</tr>
					<tr>
						<td>
							gamaS:
						</td>
						<td>
							<select class="form-control" name="gama" id="" style=" width: 150px" <?=$disabled?>>
								<?php 
									echo $gamas;
								 ?> 
							</select>
						</td>
					</tr>
					<tr>
						<td>
							latex:
						</td>
						<td>
							<select class="form-control" name="latex" id="" style=" width: 150px" <?=$disabled?>>
								<?=$latexs?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							talla:
						</td>
						<td>
							<select class="form-control" name="talla" id="" style=" width: 150px;" <?=$disabled?>>
								<?=$tallas?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							EXISTENCIA:
						</td>
						<td>
							<input class="form-control" type="number" name="existencia" value="<?=$existencia?>"  style="text-align: center; width: 150px" <?=$disabled?>>
						</td>
					</tr>
					<tr>
						<td>PRECIO:</td>
						<td><input class="form-control" type="number" name="precio" value="<?=$precio?>" style="text-align: center;  width: 150px" <?=$disabled?>></td>
					</tr>
					<?php 
						if($accion == 1 ){
							?>
							<tr>
								<td>
									IMAGEN:
								</td>
								<td>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagen">
										<label class="custom-file-label" for="customFileLang">Seleccionar imagen</label>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div>
										<button class="btn btn-outline-warning" type="submit" name="actualizar" style="width: 100%">ACTUALIZAR
										</button>
									</div>
								</td>
							</tr>
							<?php
						}else{
							if($accion==0){
							?>
								<tr>
									<td colspan="2">
										<div>
											<button class="btn btn-outline-info" type="submit" name="proveedores" style="width: 100%">PROVEEDORES
											</button>
										</div>
									</td>
								</tr>
							<?php
							}else{
							?>
								<tr>
									<td colspan="2">
										<div>
											<button class="btn btn-outline-danger" type="submit" name="eliminar" style="width: 100%">ELIMINAR
											</button>
										</div>
									</td>
								</tr>
							<?php
							}
							
						}
					?>
					
			</table>
			</form>
		<?php
	}
?>