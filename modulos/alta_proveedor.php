<?php 
$rfc="";
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
if(isset($_POST['registrar'])){
	$rfc = $_POST['rfc'];
	$nombre_proveedor = $_POST['proveedor'];
	$estado=$_POST['ESTADO'];
	$muni=$_POST['MUNICIPIO'];
	$poblacion=$_POST['poblacion'];
	$cp=$_POST['cp'];
	$calle=$_POST['calle'];
	$email1=$_POST['email1'];
	$email2=$_POST['email2'];
	$tel1=$_POST['tel1'];
	$tel2=$_POST['tel2'];

	$query = "select * from proveedor where(rfc = '$rfc')";
	$resultados = mysqli_query($conex,$query);
	if(mysqli_num_rows($resultados)>0){
		alert("EL PROVEEDOR YA EXISTE");
	}
	else{
		$query="insert into proveedor(rfc,nombre_proveedor,cp,calle,poblacion_colonia,id_estado,id_municipio)values('$rfc','$nombre_proveedor','$cp','$calle','$poblacion','$estado','$muni')";
		mysqli_query($conex,$query) or die ("error 1");
		$query="insert into email_proveedor (correo,rfc) values ('$email1','$rfc')";
		mysqli_query($conex,$query)or die ("error 2");
		if($email2 != "@" && $email2 != ""){
			$query="insert into email_proveedor (correo,rfc) values ('$email2','$rfc')";
		mysqli_query($conex,$query)or die ("error 3");
		}
		if($tel1!=""){
			$query="insert into telefono_proveedor (num_telefono,rfc) values ('$tel1','$rfc')";
		mysqli_query($conex,$query)or die ("error 4");
		}
		if($tel2!=""){
			$query="insert into telefono_proveedor (num_telefono,rfc) values ('$tel2','$rfc')";
		mysqli_query($conex,$query)or die ("error 5");
		}
		alert("PROVEEDOR REGISTRADO");
		redit("?p=alta_proveedor");
	}
}
	?>
	<body>
		<form action="" method="POST">
			<center>
				<table style="width: 50%";>
					<tr>
						<td >
							<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px">
							<label>RFC:</label>
							</div>
						</td>
						<td class="fila">
							<div class="input-group mb-3" style="margin-top: 15px">
							<input class="form-control" type="text" placeholder="RFC" name="rfc" minlength="12" maxlength="13" required="Y">
							</div>
						</td>
					</tr>
					<tr>
						<td >
							<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>NOMBRE DEL PROVEEDOR:</label>
							</div>
						</td>
						<td class="fila">
							<div class="input-group mb-3" style="margin-top: 15px">
							<input class="form-control" type="text" placeholder="NOMBRE DEL PROVEEDOR" name="proveedor" required="Y">
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
						  	<option selected disabled>SELECCIONE UN ESTADO</option>
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
						  	<option selected disabled>SELECCIONE UN MUNICIPIO</option>
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
							<label>POBLACION/COLONIA:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="poblacion" type="text" value="<?=$poblacion?>" placeholder="POBLACION/COLONIA" required>
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
						  <input class="form-control" name="email2" type="email2" value="<?=$email2?>" placeholder="EMAIL ALTERNATIVO">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>TELEFONO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel1" type="text" value="<?=$tel1?>" placeholder="TELEFONO" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>TELEFONO ALTERNATIVO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel2" type="text" value="<?=$tel2?>" placeholder="TELEFONO ALTERNATIVO">
						</div>
					</td>
				</tr>
					<tr>
						<td style="padding-top: 15px" colspan="2">
							<div align="center">
							<button type="submit" class="btn btn-success" name="registrar"  style="width: 100%">REGISTRAR
							</button>
							</div> 
						</td>
					</tr>
				</table>
			</center>
		</form>
	</body>
	</html>
		
	<?php
?>