<?php 
$modelo; 
	if(isset($_GET['modelo'])){
		$modelo = $_GET['modelo'];
		//alert($modelo);
		$query = "select proveedor.rfc, proveedor.nombre_proveedor,compra.folio_compra,compra.fecha_compra,adquirir_productos.cantidad from proveedor
					inner join provee on (proveedor.rfc = provee.rfc)
					inner join compra on (provee.folio_compra = compra.folio_compra)
					inner join adquirir_productos on (compra.folio_compra = adquirir_productos.folio_compra and adquirir_productos.modelo = '$modelo')";
		//$conex = new mysqli("localhost","root","","tienda")or die("ERROR ConEXIÓN Con SERVIDOR");
		$resultado = mysqli_query($conex,$query);
		?>
		<div align="center">
		<table>
			<tr>
				<th colspan="6">
					<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
						proveedorES
					</div>
				</th>
			</tr>
			<tr>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
						MODELO DEL PRODUCTO
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px; width: 100%">
					RFC
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
					NOMBRE DEL proveedor
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
					FOLIO DE compra
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
					FECHA DE compra
					</div>
				</td>
				<td>
					<div class="badge badge-primary text-wrap" align="center" style="padding: 6px;width: 100%">
					CANTIDAD compraDA
					</div>
				</td>
			</tr>
			<?php 
			while ($rows=mysqli_fetch_array($resultado)) {
				?>
					<tr style="color: white; border: solid; border-color: white;">
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$modelo?></div></td>
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$rows[0]?></div></td>
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$rows[1]?></div></td>
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$rows[2]?></div></td>
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$rows[3]?></div></td>
						<td style="color: white; border: solid; border-color: white;"><div align="center"><?=$rows[4]?></div></td>
					</tr>
				<?php
			}	
			?>
		</table>
		</div>
		<?php
	}
 ?>