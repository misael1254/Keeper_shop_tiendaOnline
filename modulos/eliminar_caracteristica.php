<?php
if(isset($_POST['eliminar'])){
	$id = $_POST['id'];
	$query="";
	$aux_marca= explode("_", $id);
	$id=$aux_marca[0];
	if($caracteristica==1){
		$query ="delete from marca where(id_marca = '$id')";
	}
	if($caracteristica==2){
		$query ="delete from gama where(id_gama = '$id')";
	}
	if($caracteristica==3){
		$query ="delete from talla where(id_talla = '$id')";
	}
	if($caracteristica==4){
		$query ="delete from latex where(id_latex = '$id')";
	}
	if(mysqli_query($conex,$query)){
		if($caracteristica==1){
			$carpeta = 'modulos/source/'.$aux_marca[1];
			rmDir_rf($carpeta);
		}
		alert('EXITO');
	}
}


if(isset($_GET['caracteristica'])){
	$caracteristica=$_GET['caracteristica'];
	$carac;
	if($caracteristica==1){
		$carac="marca";
	}
	if($caracteristica==2){
		$carac="gama";
	}
	if($caracteristica==3){
		$carac="talla";
	}
	if($caracteristica==4){
		$carac="latex";
	}

	?>
	<form action="" method="POST">
		<center>
			<table >
				<tr>
					<td class="fila">
						<select name="id"class="form-control" required>
							<option selected disabled >SELECCIONA <?=$carac?></option>
							<?php 
								$query="select * from ".$carac.""; 
								$resultado = mysqli_query($conex,$query);
								while ($row=mysqli_fetch_array($resultado)) {
									?>
									<option value="<?=$row[0]?>_<?=$row[1]?>"><?=$row[1]?></option>
									<?php	
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 15px">
						<button type="submit" class="btn btn-danger" name="eliminar" style="width: 100%">
							ELIMINAR <?=$carac?>
						</button>
					</td>
				</tr>
			</table>
		</center>
	</form>
	<?php

}
?>