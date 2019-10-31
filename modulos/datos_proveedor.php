<?php 
if(isset($_POST['rfc'])){
	$accion=$_POST['accion'];
	$conex =new mysqli("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR ConEXIÓN Con SERVIDOR");
	$rfc = $_POST['rfc'];
	$query = "select proveedor.rfc,proveedor.nombre_proveedor,estado.nombre_estado,municipio.municipio_delegacion,proveedor.poblacion_colonia,proveedor.calle,proveedor.cp
	from proveedor
	inner join estado on (proveedor.id_estado = estado.id_estado and proveedor.rfc='$rfc')
	inner join municipio on (proveedor.id_municipio = municipio.id_municipio)";
	$resultados = mysqli_query($conex,$query);
	$rows = mysqli_fetch_array($resultados);
	$rfc=$rows[0];
	?>
	<form action="" method="POST">
	<table style="color: white; width: 50%">
		<tr>
			<th colspan="2">
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 25px; padding-top: 10px; background-color: gray; color: white">
					DATOS DEL PROVEEDOR
				</div>
			</th>
		</tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					RFC
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[0]?>" disabled>
			</td>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					NOMBRE DEL PROVEEDOR
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[1]?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					ESTADO
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[2]?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					MUNICIPIO
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[3]?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					POBLACIÓN/COLonIA
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[4]?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					CALLE
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[5]?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
					CÓDIGO POSTAL
				</div>
			</td>
			<td>
				<input class="form-control" type="text" value="<?=$rows[6]?>" disabled>
			</td>
		</tr>
		<?php 
			$query="select * from email_proveedor where(rfc='$rfc')";
			$resultados = mysqli_query($conex,$query);
			if(mysqli_num_rows($resultados)>0){
				$vuelta=1;
				while ($rows=mysqli_fetch_array($resultados)) {
					?>
					<tr>
						<td>
							<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
								EMAIL<?=$vuelta?>
							</div>
						</td>
						<td>
							<input class="form-control" type="text" value="<?=$rows[0]?>" disabled>
						</td>
					</tr>
					<?php
					$vuelta +=1;
				}
			}
			$query="select * from telefono_proveedor where(rfc='$rfc')";
			$resultados = mysqli_query($conex,$query);
			if(mysqli_num_rows($resultados)>0){
				$vuelta=1;
				while ($rows=mysqli_fetch_array($resultados)) {
					?>
					<tr>
						<td>
							<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px">
								TELEFonO<?=$vuelta?>
							</div>
						</td>
						<td>
							<input class="form-control" type="text" value="<?=$rows[0]?>" disabled>
						</td>
					</tr>
					<?php
					$vuelta +=1;
				}
			}
			if($accion==1){
				?>
				
					<tr>
						<td colspan="2">
							<div style="width: 100%">
								<input class="btn btn-danger" name="eliminar" type="submit" value="ELIMINAR" style="width: 100%" >
								
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="rfc" hidden value="<?=$rfc?>">
						</td>
					</tr>
				
				<?php
			}
		 ?>
	</table>
	</form>
	<?php
}
?>