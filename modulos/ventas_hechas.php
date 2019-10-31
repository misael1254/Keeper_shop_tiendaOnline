<?php 
include "../config/config.php";
if(isset($_POST['f_i'])){
	$f_i=$_POST['f_i'];
	$f_f=$_POST['f_f'];
	$conex = mysqli_connect("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");
	$query="select venta.folio_venta,venta.fecha_venta,cliente.nombre_cliente,cliente.ap_paterno,cliente.ap_materno,venta.total from venta
		inner join cliente on (venta.id_cliente = cliente.id_cliente and venta.fecha_venta between '$f_i' and '$f_f')";
	$resultados=mysqli_query($conex,$query);
	if(mysqli_num_rows($resultados)>0){
		?>
		<table>
		<tr>
			<th colspan="4">
				<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
					VENTAS
				</div>
			</th>
		</tr>
		<tr>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
						FOLIO DE VENTA
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px; width: 100%">
						FECHA DE VENTA
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
						NOMBRE COMPRADOR
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
					TOTAL
					</div>
				</td>
			</tr>
		<?php 
			while ($rows=mysqli_fetch_array($resultados)) {
				?>
					<tr>
						<td style="color: white; border: solid; border-color: white;">
							<div align="center">
								<?=$rows[0]?>
							</div>
						</td>
						<td style="color: white; border: solid; border-color: white;">
							<div align="center"><?=$rows[1]?></div>
						</td>
						<td style="color: white; border: solid; border-color: white;">
							<div align="center"><?=$rows[2]?> <?=$rows[3]?> <?=$rows[4]?></div></td>
						<td style="color: white; border: solid; border-color: white;">
							<div align="center"><?=$rows[5]?></div>
						</td>
					</tr>
				<?php
			}
			?>
			
			<?php
		 ?>
		 <tr>
		 	<td colspan="4">
		 		<div align="center">
					<form action="modulos/pdf_ventas.php" method="POST">
						<input type="text" name="f_i" hidden value="<?=$f_i?>">
						<input type="text" name="f_f" hidden value="<?=$f_f?>">
						<button name="pdf" class="form-control" type="submit" style="width: 30%">PDF</button>
					</form>
				</div>
		 	</td>
		 </tr>
		</table>
		<?php
	}else{
		?>
		<table>
			<tr>
			<th colspan="4">
				<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
					SIN RESULTADOS
				</div>
			</th>
		</tr>
		</table>
		<?php
	}
}

?>