<?php 
$tu=0;
if(isset($_POST['ingresar'])){
	$usu=$_POST['usu'];
	$con=$_POST['con'];
	alert($usu);
	alert($con);
	$t_u;
	$conex = mysqli_connect("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");
	$query = "select * from usuario where (nombre_usu = '$usu' and password = '$con')";
	$resultado = mysqli_query($conex,$query);
	if(mysqli_num_rows($resultado)>0){
		$consulta = mysqli_fetch_array($resultado);
		$_SESSION['id'] = $consulta[0];
		$t_u=$consulta[2];
		$_SESSION['t_u']=$t_u;
	}else{
		alert("DATOS NO VALIDOS");
	//	redit("?p=login");
	}
}
if(isset($_POST['REGISTRAR'])){
	$contra=$_POST['contra'];
	$usuario=$_POST['n_u'];
	if($contra != $_POST['cond']){
		alert('LAS CONTRASEÑAS NO SON IGUALES');
		redit("?p=login");
	}else{
		$resultado = mysqli_query($conex,"select * from usuario where(nombre_usu='$usuario')") or die("ERROR BUSCAR usuario REGISTRAR");
		if(mysqli_num_rows($resultado)==0){
			mysqli_query($conex,"insert into usuario (nombre_usu,password,tipo_usu) values ('$usuario','$contra','2')");
			$_SESSION['id']=$usuario;
			$_SESSION['t_u']=2;
			alert('REGISTRADO EXITOSAMENTE');
			alert('BIENVENIDO');
			redit("?p=inicio");
		}else{
			alert('EL NOMBRE DE usuario YA EXISTE');
		}
	}
}
if(isset($_SESSION['id'])){
	if($t_u =='1'){
		redit("?p=menu");
	}
	else{
		redit("?p=inicio");
	}
}else{
	?>
		<body style="background-color: #343a40">
			<div>
			<form action="" method="POST">
				<center>
					<div class="shadow-lg p-3 mb-5 text-light bg-dark rounded">
					  <div class="container">
					    <label><h1 class="display-4"><i class="fas fa-user-circle"></i>INICIAR SESIÓN</h1></label>
					  </div>
					</div>
					<div style="width: 50%;text-align: center; margin-top: 10px;">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="usuario" name="usu"/>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" placeholder="Contraseña" name="con"/>
						</div>
						
						<div class="form-group">
							<span>
							<input class="btn btn-light" type="submit" name="ingresar" value="INGRESAR">
							</span>
						</div>
					</div>	
				</center>
			</form>
			</div>
			<div>
			<form action="" method="POST">
				<center>
					<div class="shadow-lg p-3 mb-5 text-light bg-dark rounded">
					  <div class="container">
					    <label><h1 class="display-4"><i class="fas fa-user-plus"></i> REGISTRARSE <i class="fas fa-user-plus"></i></h1></label>
					  </div>
					</div>
					<div style="width: 50%;text-align: center; margin-top: 10px;">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="NOMBRE DE usuario" name="n_u"/>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" placeholder="CONTRASEÑA" name="contra"/>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="REPETIR CONTRASEÑA" name="cond"/>
						</div>
						<div class="form-group">
							<span>
								<button class="btn btn-light" type="submit" name="REGISTRAR">
									<i class="fas fa-angle-double-right"></i> REGISTRAR <i class="fas fa-angle-double-left"></i></button>
							</span>
						</div>
					</div>	
				</center>
			</form>
			</div>
		</body>
		
	<?php
}
?>