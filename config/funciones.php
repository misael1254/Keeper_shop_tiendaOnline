<?php 
	$conex=new mysqli($host_mysql,$user_mysql,$password,$db_mysql)or die("ERROR CONEXIÓN CON SERVIDOR");
	//mysql_connect($host_mysql,$user_mysql,$password) or die("ERROR CONEXIÓN CON SERVIDOR");
	//mysql_select_db($db_mysql) or die("ERROR DE CONEXION CON BASE DE DATOS");
	
function limpiar($var){
	htmlentities($var, ENT_QUOTES,'UTF-8'); // así de sencillo
	return $var;
}

function clear($var){
	htmlspecialchars($var);
	return $var;
}

function redit($var){
	?>
		<script>
			window.location="<?=$var?>";
		</script>
	<?php
	die();
}
function alert($var){
	?>
		<script type="text/javascript">
			alert("<?=$var?>");
		</script>
	<?php
}
function confirmar($var){
	?>
		<script type="text/javascript">
			window.confirm("<?=$var?>");
		</script>
	<?php
}

 function rmDir_rf($carpeta)
 {
 	foreach(glob($carpeta . "/*") as $archivos_carpeta){             
 		if (is_dir($archivos_carpeta)){
 			rmDir_rf($archivos_carpeta);
 		} else {
 			unlink($archivos_carpeta);
 		}
 	}
 	rmdir($carpeta);
 }

 function nueva_pestaña ($nombre_php){
 	?>
	<script type="text/javascript">
			window.open('/modulos/<?=$nombre_php?>.php','_blank');
	</script>
 	<?php
 }

?>