<?php 
	
	$query="select * from usuario";
	$resultado = mysqli_query($conex,$query);
	if(isset($_POST['usuario'])){
		if($_SESSION['id'] == $_POST['usuario']){
			alert("NO PUEDE BORRAR SU PROPIO usuario");
		}else{
			$usuario=$_POST['usuario'];
			alert($usuario);
			$query="delete from usuario where(nombre_usu='$usuario')";
			if(mysqli_query($conex,$query)){
				alert("ELIMINADO");
				redit("?p=eliminar_usuario");
			}
		}
	}

	?>
	<div align="center">
		<form action="" method="POST">
			<table>
				<tr>
					<td>
						<select name="usuario" style="width: 100%" class="form-control">
							<?php 
							while($rows=mysqli_fetch_array($resultado)){
								?>
								<option value="<?=$rows['nombre_usu']?>"><?=$rows['nombre_usu']?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							<button class="btn btn-outline-danger" type="submit" name="eliminar" style="width: 100%">ELIMINAR USUARIO
							</button>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
 ?>