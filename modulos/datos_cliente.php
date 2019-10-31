<?php  
include "clase_carrito.php";
$act=$_GET['act'];
$carro = new carrito();
if(isset($_SESSION['id'])){
$nombre_usu=$_SESSION['id'];
}
$nombre_usu;
$resultados="";
$nom_cliente ="";
$ap_pat="";
$ap_mat="";
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
$id_cliente="";

if(isset($_POST['terminar'])){
	$nombre_cliente=$_POST['nom_cliente'];
	$ap_pat=$_POST['ap_pat'];
	$ap_mat=$_POST['ap_mat'];
	$estado=$_POST['ESTADO'];
	$muni=$_POST['MUNICIPIO'];
	$poblacion=$_POST['poblacion'];
	$cp=$_POST['cp'];
	$calle=$_POST['calle'];
	$aux1=$_POST['email1'];
	$aux2=$_POST['email2'];
	$aux3=$_POST['tel1'];
	$aux4=$_POST['tel2'];

	$query = "select * from cliente where(nombre_usu ='$nombre_usu')";
	$resultados = mysqli_query($conex,$query);
	if(mysqli_num_rows($resultados)>0){
		$rows=mysqli_fetch_array($resultados);
		$id_cliente=$rows['id_cliente'];
		$carro->Save_data_client($id_cliente);
		$query="update cliente set nombre_cliente = '$nombre_cliente',ap_paterno='$ap_pat',ap_materno='$ap_mat',cp='$cp',calle='$calle',poblacion_colonia='$poblacion',id_estado='$estado',id_municipio='$muni' where(nombre_usu='$nombre_usu') ";
		mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR cliente");
		$query="select * from email where(id_cliente='$id_cliente')";
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
		$query= "select * from telefono where(id_cliente = '$id_cliente')";
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
		if($email1=="@"){
			if($aux1!=""){
				$query = "insert into email (correo,id_cliente) values ('$aux1','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR");
			}
		}else{
			$query="update email set correo='$aux1' where (correo='$email1' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR email");
		}
		if($email2=="@"){
			if($aux2!=""){
				$query = "insert into email (correo,id_cliente) values ('$aux2','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR E-AL");
			}
		}else{
			$query="update email set correo='$aux2' where (correo='$email2' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR E-AL");
		}
		if($tel1!=""){
			$query="update telefono set num_telefono='$aux3' where (num_telefono='$tel1' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T");
		}else{
			if($aux3!=""){
				$query = "insert into telefono (num_telefono,id_cliente) values ('$aux3','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR T");
			}
		}
		if($tel2!=""){
			$query="update telefono set num_telefono='$aux4' where (num_telefono='$tel2' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T-AL");
		}else{
			if($aux4!=""){
				$query = "insert into telefono (num_telefono,id_cliente) values ('$aux4','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR T-AL");
			}
		}
		//alert('DATOS ACTUALIZADOS CORRECTAMENTE');
		}
	else{
		$resultado = mysqli_query($conex, "select max(id_cliente) from cliente") or die ('error al consultar  max color');
		if(mysqli_num_rows($resultado)>0){
			$aux = mysqli_fetch_array($resultado);
			$id_cliente = $aux[0];
			$id_cliente = $id_cliente + 1;
		}
		else{
			$id_cliente=1;
		}
		$query = "insert into cliente (id_cliente,nombre_cliente,ap_paterno,ap_materno,cp,calle,poblacion_colonia,nombre_usu,id_estado,id_municipio)values('$id_cliente','$nombre_cliente','$ap_pat','$ap_mat','$cp','$calle','$poblacion','$nombre_usu','$estado','$muni');";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR");
		$query = "insert into email (correo,id_cliente) values ('$aux1','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR E");
		$query = "insert into email (correo,id_cliente) values ('$aux2','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR E-AL");
		$query = "insert into telefono (num_telefono,id_cliente) values ('$aux3','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR T");
		$query = "insert into telefono (num_telefono,id_cliente) values ('$aux4','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR T-AL");
		//alert('SUS DATOS HAN SIDO GUARDADOS CORRECTAMENTE');
	}
	

	//$id_cliente=$_POST['id_cliente'];
	//alert($id_cliente);
	
	//$carro->comprar($id_cliente);
	//redit("?p=pdf_recibo");
	redit("?p=tarjeta&id_cliente=".$id_cliente);

}


if(!isset($act)){
	
	redit("?p=inicio");
}
if($act ==""){
	redit("?p=inicio");
}

if(isset($_POST['actualizar'])){
	$nombre_cliente=$_POST['nom_cliente'];
	$ap_pat=$_POST['ap_pat'];
	$ap_mat=$_POST['ap_mat'];
	$estado=$_POST['ESTADO'];
	$muni=$_POST['MUNICIPIO'];
	$poblacion=$_POST['poblacion'];
	$cp=$_POST['cp'];
	$calle=$_POST['calle'];
	$aux1=$_POST['email1'];
	$aux2=$_POST['email2'];
	$aux3=$_POST['tel1'];
	$aux4=$_POST['tel2'];
	$query = "select * from cliente where(nombre_usu ='$nombre_usu')";
	$resultados = mysqli_query($conex,$query);
	if(mysqli_num_rows($resultados)>0){
		$rows=mysqli_fetch_array($resultados);
		$id_cliente=$rows['id_cliente'];
		$query="update cliente set nombre_cliente = '$nombre_cliente',ap_paterno='$ap_pat',ap_materno='$ap_mat',cp='$cp',calle='$calle',poblacion_colonia='$poblacion',id_estado='$estado',id_municipio='$muni' where(nombre_usu='$nombre_usu') ";
		mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR cliente");
		$query="select * from email where(id_cliente='$id_cliente')";
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
		$query= "select * from telefono where(id_cliente = '$id_cliente')";
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
		if($email1=="@"){
			if($aux1!=""){
				$query = "insert into email (correo,id_cliente) values ('$aux1','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR");
			}
		}else{
			$query="update email set correo='$aux1' where (correo='$email1' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR email");
		}
		if($email2=="@"){
			if($aux2!=""){
				$query = "insert into email (correo,id_cliente) values ('$aux2','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR E-AL");
			}
		}else{
			$query="update email set correo='$aux2' where (correo='$email2' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR E-AL");
		}
		if($tel1!=""){
			$query="update telefono set num_telefono='$aux3' where (num_telefono='$tel1' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T");
		}else{
			if($aux3!=""){
				$query = "insert into telefono (num_telefono,id_cliente) values ('$aux3','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR T");
			}
		}
		if($tel2!=""){
			$query="update telefono set num_telefono='$aux4' where (num_telefono='$tel2' and id_cliente = '$id_cliente')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T-AL");
		}else{
			if($aux4!=""){
				$query = "insert into telefono (num_telefono,id_cliente) values ('$aux4','$id_cliente')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR T-AL");
			}
		}
		alert('DATOS ACTUALIZADOS CORRECTAMENTE');
		}
	else{
		$resultado = mysqli_query($conex, "select max(id_cliente) from cliente") or die ('error al consultar  max color');
		if(mysqli_num_rows($resultado)>0){
			$aux = mysqli_fetch_array($resultado);
			$id_cliente = $aux[0];
			$id_cliente = $id_cliente + 1;
		}
		else{
			$id_cliente=1;
		}
		$query = "insert into cliente (id_cliente,nombre_cliente,ap_paterno,ap_materno,cp,calle,poblacion_colonia,nombre_usu,id_estado,id_municipio)values('$id_cliente','$nombre_cliente','$ap_pat','$ap_mat','$cp','$calle','$poblacion','$nombre_usu','$estado','$muni');";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR");
		$query = "insert into email (correo,id_cliente) values ('$aux1','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR E");
		$query = "insert into email (correo,id_cliente) values ('$aux2','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR E-AL");
		$query = "insert into telefono (num_telefono,id_cliente) values ('$aux3','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR T");
		$query = "insert into telefono (num_telefono,id_cliente) values ('$aux4','$id_cliente')";
		mysqli_query($conex,$query) or die("ERROR AL INSERTAR T-AL");
		alert('SUS DATOS HAN SIDO GUARDADOS CORRECTAMENTE');
	}
}

	if(!isset($_SESSION['id'])){
		redit("?p=login");
	}
	else{
		$nombre_usu = $_SESSION['id'];
		$total = $carro->get_total();
		//$query= "select * from telefono where(id_cliente = '$id_cliente')";
		$query="select cliente.nombre_cliente,cliente.ap_paterno,cliente.ap_materno,cliente.cp,cliente.calle,cliente.poblacion_colonia,estado.nombre_estado,municipio.municipio_delegacion,estado.id_estado,cliente.id_cliente
			from cliente
			inner join usuario on (cliente.nombre_usu = usuario.nombre_usu and cliente.nombre_usu = '$nombre_usu')
			inner join estado on (cliente.id_estado = estado.id_estado)
			inner join municipio on (cliente.id_municipio = municipio.id_municipio)";
		$resultados=mysqli_query($conex,$query);
		if(mysqli_num_rows($resultados)>0){
			$rows=mysqli_fetch_array($resultados);
			$nom_cliente =$rows[0];
			$ap_pat=$rows[1];
			$ap_mat=$rows[2];
			$cp =$rows[3];
			$calle=$rows[4];
			$poblacion=$rows[5];
			$nombre_est=$rows[6];
			$muni=$rows[7];
			$iest=$rows[8];
			$id_cliente=$rows[9];

			
		}
		$query= "select * from telefono where(id_cliente = '$id_cliente')";
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
		$query="select * from email where(id_cliente='$id_cliente')";
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
		//alert($nom_cliente.','.$ap_pat.','.$ap_mat.','.$cp.','.$calle.','.$poblacion.','.$nombre_est.','.$muni.','.$id_cliente.','.$email1.','.$email2.','.$tel1.','.$tel2);
		?>
		<div>
		<form action="" method="POST">
			<table width="50%; " align="center">
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>NOMBRE(S)</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="nom_cliente" type="text" value="<?=$nom_cliente?>" placeholder="NOMBRE(S)" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>APELLIDO PATERNO</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="ap_pat" type="text" value="<?=$ap_pat?>" placeholder="APELLIDO PAT" required >
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>APELLIDO MATERNO</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="ap_mat" type="text" value="<?=$ap_mat?>" placeholder="APELLIDO MAT" required>
						</div>
					</td>
				</tr><tr>
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
							<label>email:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="email1" type="email" value="<?=$email1?>" placeholder="email">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>email ALTERNATIVO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="email2" type="email2" value="<?=$email2?>" placeholder="email ALTERNATIVO">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>telefono:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel1" type="text" value="<?=$tel1?>" placeholder="telefono">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="badge badge-primary text-wrap" style=" width:100%; font-size: 15px;">
							<label>telefono ALTERNATIVO:</label>
						</div>
						
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <input class="form-control" name="tel2" type="text" value="<?=$tel2?>" placeholder="telefono ALTERNATIVO">
						</div>
					</td>
				</tr>
				<?php 
					if(isset($_SESSION['car']) and $act==0){
						?>
				<!--<tr>
					<td rowspan="2">
						<div class="badge badge-primary text-wrap" style="width:100%; font-size: 15px">
						<label style="border-radius: 5">TIPO DE PAGO</label>
						</div>
					</td> 
					<td>
						<input type="radio" value="TARGETA_CREDITO" name="tipo_pago" style="color: #FFFFFF" checked>
						<font style="color: #FFFFFF">TARJETA DE CREDITO</font> 
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" value="TARGETA_DEBITO" name="tipo_pago" > 
						<font style="color: #FFFFFF">TARJETA DE DEBITO</font> 
					</td>
				</tr>
				<tr>-->
					<td>
						<div class="badge badge-primary text-wrap" style="width:100%; font-size: 15px">
						<label>MonTO TOTAL</label>
						</div>
					</td>
					<td>
						<div class="input-group mb-3" style="margin-top: 15px">
						  <div class="input-group-prepend">
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" id="id_total" name="total" value="<?=$total?>" required>
						</div>
					</td>
				</tr>
						<?php
					}
				 ?>
				<?php 
					if($act==1){
						?>

						<tr>
							<td colspan="2">
								<button type="submit" class="btn btn-danger " style="width: 100%" name="actualizar">ACTUALIZAR DATOS PERSonALES</button>
							</td>
						</tr>
						<?php
					}
					else
					{	if(isset($_SESSION['car']) and $act==0){
						?>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-danger " style="width: 100%" name="terminar">TERMINAR COMPRA</button>
								</td>
								<td>
									<input hidden name="id_cliente" value="<?=$id_cliente?>">
								</td>
							</tr>
						<?php
						}
					}
				 ?>
				
			</table>
		</form>	
		</div>
		<?php
	}
	
?>