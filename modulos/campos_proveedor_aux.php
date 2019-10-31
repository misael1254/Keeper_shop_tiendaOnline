<?php 
if(isset($_POST['rfc'])){
	$resultados="";
	$rfc = $_POST['rfc'];
	$nombre_proveedor="";
	$cp ="";
	$calle="";
	$poblacion="";
	$nombre_est="";
	$muni="";
	$iest="";
	$email1="@";
	$email2="@";
	$tel1="";
	$tel2="";
	$iest="";
	$conex = new mysqli("localhost","root","","tienda")or die("ERROR ConEXIÓN Con SERVIDOR");
	$query="select proveedor.rfc,proveedor.nombre_proveedor,proveedor.cp,proveedor.calle,proveedor.poblacion_colonia,estado.nombre_estado,municipio.municipio_delegacion,proveedor.id_estado
			from proveedor 
			inner join estado on(proveedor.id_estado = estado.id_estado and proveedor.rfc='$rfc')
			inner join municipio on(proveedor.id_municipio = municipio.id_municipio and municipio.id_estado = estado.id_estado)";
	$resultados=mysqli_query($conex,$query);
		if(mysqli_num_rows($resultados)>0){
			$rows=mysqli_fetch_array($resultados);
			$rfc=$rows[0];
			$nombre_proveedor=$rows[1];
			$cp =$rows[2];
			$calle=$rows[3];
			$poblacion=$rows[4];
			$nombre_est=$rows[5];
			$muni=$rows[6];	
			$iest=$rows[7];	
		}
	$query= "select * from telefono_proveedor where(rfc = '$rfc')";
		$resultados=mysqli_query($conex,$query);
		$vueltas=0;
		if(mysqli_num_rows($resultados)>0){
			while($rows=mysqli_fetch_array($resultados)) {
				if($vueltas==0){
					$tel1 = $rows[0];
				}
				if($vueltas==1){
					$tel2 = $rows[0];
				}
			$vueltas = $vueltas+1;
			}
		}
		$query="select * from email_proveedor where(rfc='$rfc')";
		$resultados=mysqli_query($conex,$query);
		$vueltas=0;
		if(mysqli_num_rows($resultados)>0){
			while($rows=mysqli_fetch_array($resultados)) {
				if($vueltas==0){
					$email1 = $rows[0];
				}
				if($vueltas==1){
					$email2 = $rows[0];
				}
			$vueltas = $vueltas+1;
			}
		}
	?>
	<div>
		<form action="" method="POST">
			<table width="50%; " align="center">
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>RFC</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="rfc" type="text" value="<?=$rfc?>" placeholder="RFC" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>NOMBRE DEL PROVEEDOR</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="nombre_proveedor" type="text" value="<?=$nombre_proveedor?>" placeholder="PROVEEDOR" required >
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px">
						<label>ESTADO:</label>
						</div>
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <select class="form-control" name="ESTADO" required="Y" id="" onchange="CargaMunicipios(this.value,'<?=$muni?>')">
						  	<option selected disabled>SELECCIonE UN ESTADO</option>
						  	<?php 
						  		$query="select id_estado,nombre_estado from estado;";
								$resultados=mysqli_query($conex,$query);
								while($fila=mysqli_fetch_array($resultados)){
									if($fila['nombre_estado'] == $nombre_est){
										?>
											<option value="<?=$fila['id_estado']?>" selected><?=$fila['nombre_estado']?></option>
										<?php
									}
									else{
										?>
											<option value="<?=$fila['id_estado']?>"><?=$fila['nombre_estado']?></option>
										<?php
									}
									
								}
						  	 ?>	
						  </select>
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px">
						<label>MUNICIPIO/DELEGACIÓN:</label>
						</div>
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <select class="form-control" id="MUNICIPIO" name="MUNICIPIO" required="Y">
						  	<option selected disabled>SELECCIonE UN MUNICIPIO</option>
						  	<?php 
						  		$query="select * from municipio where(id_estado = '$iest');";
								$resultados=mysqli_query($conex,$query);
								while($fila=mysqli_fetch_array($resultados)){
									if($fila['municipio_delegacion'] == $muni){
										?>
											<option value="<?=$fila['id_municipio']?>" selected><?=$fila['municipio_delegacion']?></option>';
										<?php
									}
									else{
										?>
											<option value="<?=$fila['id_municipio']?>"><?=$fila['municipio_delegacion']?></option>';
										<?php
									}
									
								}
						  	 ?>
						  	</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>POBLACIon/COLonIA:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="poblacion" type="text" value="<?=$poblacion?>" placeholder="POBLACIon/COLonIA" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>CALLE:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="calle" type="text" value="<?=$calle?>" placeholder="CALLE" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>CODIGO POSTAL:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="cp" type="text" value="<?=$cp?>" placeholder="cp" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>EMAIL:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="email1" type="email" value="<?=$email1?>" placeholder="email" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>EMAIL ALTERNATIVO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="email2" type="email" value="<?=$email2?>" placeholder="EMAIL ALTERNATIVO">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>TELEFonO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel1" type="text" value="<?=$tel1?>" placeholder="TELEFonO" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>TELEFonO ALTERNATIVO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel2" type="text" value="<?=$tel2?>" placeholder="TELEFonO ALTERNATIVO">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" hidden name="aux1" value="<?=$rfc?>">
						<input type="text" hidden name="aux8" value="<?=$email1?>">
						<input type="text" hidden name="aux9" value="<?=$email2?>">
						<input type="text" hidden name="aux10" value="<?=$tel1?>">
						<input type="text" hidden name="aux11" value="<?=$tel2?>">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" class="btn btn-danger " style="width: 100%" name="actualizar">ACTUALIZAR DATOS PERSonALES</button>
					</td>
				</tr>
			</table>
		</form>	
		</div>
	<?php
}
?>