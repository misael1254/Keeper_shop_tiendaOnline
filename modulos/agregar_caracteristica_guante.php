<?php 
if(isset($_POST['registrar'])){
	$nombre = $_POST['NOMBRE'];
	$query="";
	$id;
	if($caracteristica==1){
		$resultado = mysqli_query($conex, "select id_marca from marca") or die ('error al consultar  max');

		$numero = mysqli_num_rows($resultado);
		$id=1 + $numero;
		$query ="insert into marca (id_marca,marca) values('$id','$nombre')";

	}
	if($caracteristica==2){
		$resultado = mysqli_query($conex, "select id_gama from gama") or die ('error al consultar  max');
		$numero = mysqli_num_rows($resultado);
		$id=1 + $numero;
		$query ="insert into gama (id_gama,gama) values('$id','$nombre')";
	}
	if($caracteristica==3){
		$resultado = mysqli_query($conex, "select id_talla from talla") or die ('error al consultar  max');

		$numero = mysqli_num_rows($resultado);
		$id=1 + $numero;
		$query ="insert into talla (id_talla,talla) values('$id','$nombre')";
	}
	if($caracteristica==4){
		$resultado = mysqli_query($conex, "select id_latex from latex") or die ('error al consultar  max');

		$numero = mysqli_num_rows($resultado);
		$id=1 + $numero;
		$query ="insert into latex (id_latex,latex) values('$id','$nombre')";
	}
	if(mysqli_query($conex,$query)){
		if($caracteristica==1){
			$carpeta = 'modulos/source/'.$nombre;
			if (!file_exists($carpeta)) {
			    mkdir($carpeta, 0777, true);
			}
		}
		alert('EXITO');
	}
}

if(isset($_GET['caracteristica'])){
	$caracteristica=$_GET['caracteristica'];
	$placeholder;
	$maxlength;
	$carac;
	$type="text";
	if($caracteristica==1){
		$placeholder='NOMBRE DE LA MARCA';
		$maxlength=25;
		$carac="MARCA";
	}
	if($caracteristica==2){
		$placeholder='GAMA DEL GUANTE';
		$maxlength=11;
		$carac="GAMA";
	}
	if($caracteristica==3){
		$placeholder='TALLA DEL GUANTE (NUMERO)';
		$maxlength=2;
		$carac="TALLA";
		$type="number";
	}
	if($caracteristica==4){
		$placeholder='LATEX DEL GUANTE';
		$maxlength=25;
		$carac="LATEX";
	}

	?>
	<form action="" method="POST">
		<center>
			<table style="width: 50%";>
				<tr>
					<td class="fila">
						<input class="form-control form-control-lg" type="<?=$type?>" maxlength="<?=$maxlength?>" placeholder="<?=$placeholder?>" name="NOMBRE" required>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 15px">
						<button type="submit" class="btn btn-success" name="registrar">REGISTRAR <?=$carac?></button>
					</td>
				</tr>
			</table>
		</center>
	</form>
	<?php

}
?>
