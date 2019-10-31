<?php 
$id_estado=$_POST['id'];
$id_mun=$_POST['id_muni'];
$con = new mysqli("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");
	$query="select * from municipio where(id_estado ='$id_estado')";
	$resultados=mysqli_query($con,$query);
	while($fila=mysqli_fetch_array($resultados)){
		if($fila['municipio_delegacion'] == $id_mun)
		{
		echo '<option value="'.$fila['id_municipio'].'" selected>'.$fila['municipio_delegacion'].'</option>';	
		}else{
			echo '<option value="'.$fila['id_municipio'].'">'.$fila['municipio_delegacion'].'</option>';
		}
		
	}
 ?>