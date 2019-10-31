<?php 
$accion;
if(isset($_GET['accion'])){
	$accion=$_GET['accion'];
}
if(isset($_POST['eliminar'])){
	$rfc=$_POST['rfc'];

	$query = "delete from proveedor where (rfc = '$rfc')";
	if(mysqli_query($conex,$query)){
		alert("ELIMINADO CON ÉXITO");
	}

}

if(isset($_POST['actualizar'])){
	$rfc = $_POST['rfc'];
	$nombre_proveedor=$_POST['nombre_proveedor'];
	$cp=$_POST['cp'];
	$calle=$_POST['calle'];
	$poblacion=$_POST['poblacion'];
	$iest=$_POST['ESTADO'];
	$muni=$_POST['MUNICIPIO'];
	$email1=$_POST['email1'];
	$email2=$_POST['email2'];
	$tel1=$_POST['tel1'];
	$tel2=$_POST['tel2'];
	$aux1=$_POST['aux1'];
	$aux8=$_POST['aux8'];
	$aux9=$_POST['aux9'];
	$aux10=$_POST['aux10'];
	$aux11=$_POST['aux11'];
	alert($email2);
	$query = "update proveedor set rfc='$rfc',nombre_proveedor='$nombre_proveedor',cp='$cp',calle='$calle',poblacion_colonia='$poblacion',id_estado='$iest',id_municipio='$muni' where(rfc='$aux1')";
	mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR PROVEEDOR");
	$query="update email_proveedor set correo='$email1' where (correo='$aux8' and rfc = '$rfc')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR E");
	$query="update telefono_proveedor set num_telefono='$tel1' where (num_telefono='$aux10' and rfc = '$rfc')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T");
	if($aux9=="@"){
			if($email2!=""){
				$query = "insert into EMAIL_PROVEEDOR (correo,rfc) values ('$email2','$rfc')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR EMAIL_ALT");
			}
		}else{
			$query="update email_proveedor set correo='$email2' where (correo='$aux9' and rfc = '$rfc')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR EMAIL_ALT");
		}
	if($aux11!=""){
			$query="update telefono_proveedor set num_telefono='$tel2' where (num_telefono='$aux11' and rfc = '$rfc')";
			mysqli_query($conex,$query)or die("ERROR AL ACTUALIZAR T_ALT");
		}else{
			if($tel2!=""){
				$query = "insert into telefono_proveedor (num_telefono,rfc) values ('$tel2','$rfc')";
				mysqli_query($conex,$query) or die("ERROR AL INSERTAR T_ALT");
			}
		}
		alert("DATOS DE PROVEEDOR ACTUALIZADO");
}

?>
<div align="center">
	<table>
		<tr>
			<td>
				<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 20px; padding-top: 10px; background-color: red; color: white; margin-top: 5px; margin-bottom: 5px">
					SELECCIONE PROVEEDOR
				</div>
			</td>
			<td>
				<?php 
					if($accion==2){
						?>
						<select class="form-control" name="proveedor" id="" onchange="actualizar_proveedor(this.value)">
							<option disabled selected>SELECCIONE PROVEEDOR</option>
							<?php 
							$query = "select rfc,nombre_proveedor from proveedor";
							$resultado=mysqli_query($conex,$query);
							if(mysqli_num_rows($resultado)>0){
								while ($rows=mysqli_fetch_array($resultado)) {
									?>
									<option value="<?=$rows[0]?>"><?=$rows[1]?></option>
									<?php
								}
							}
							?>
						</select>
						<?php
					}
					else{
						?>
						<select class="form-control" name="proveedor" id="" onchange="cargar_proveedor(this.value,'<?=$accion?>')">
							<option disabled selected>SELECCIONE PROVEEDOR</option>
							<?php 
							$query = "select rfc,nombre_proveedor from proveedor";
							$resultado=mysqli_query($conex,$query);
							if(mysqli_num_rows($resultado)>0){
								while ($rows=mysqli_fetch_array($resultado)) {
									?>
									<option value="<?=$rows[0]?>"><?=$rows[1]?></option>
									<?php
								}
							}
							?>
						</select>
						<?php
					}
				 ?>
				
			</td>
		</tr>
	</table>
</div>
<div id="divsito" align="center">
	<table></table>
</div>