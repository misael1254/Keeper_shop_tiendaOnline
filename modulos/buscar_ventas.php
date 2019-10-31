<?php 

	?>
	<div align="center">
		<table width="50%">
			<tr>
				<td>
					<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 17px; padding-top: 10px; background-color: red; color: white; margin-top: 5px; margin-bottom: 5px">
						BUSCAR DE:
					</div>
				</td>
				<td style=" width: 2%">
					<input class="form-control" type="date" id="F_I" style="width: 100%">
				</td>
				<td >
					<div class="badge badge-primary text-wrap" style="width: 100%;font-size: 17px; padding-top: 10px; background-color: red; color: white; margin-top: 5px; margin-bottom: 5px" align="center">
						A                     
					</div>
				</td>
				<td style="width: 2%">
					<input class="form-control" type="date" id="F_F" style="width: 100%">
				</td>
				<td>
					<input class="form-control btn btn-info" type="button" onclick="cargar_venta($('#F_I').val(),$('#F_F').val())" value="CONSULTAR">
				</td>
			</tr>
			<tr>
				
			</tr>
		</table>
	</div>
	<div id="divsito" align="center">
	<table></table>
	</div>
	<?php
?>