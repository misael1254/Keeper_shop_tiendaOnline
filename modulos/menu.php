<?php 
if(!isset($_SESSION['id'])){
	redit("?p=inicio");
}
else{
	if($_SESSION['t_u']!=1){
		redit("?p=inicio");
	}
}
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>MENU</title>
	</head>
	<body style="background-color: #18171C">
			<div align="center">
				<table class="table-light" style="display: inline-block; margin-left: 5%; margin-right: 5%; margin-top: 1%">
					<tr>
						<th colspan="2">
							<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
								CONSULTAS
							</div>
						</th>
					</tr>
					<tr>
						<td>
							<a href="?p=buscar_proveedor&accion=0" class="btn btn-outline-info btn-lg btn-block">
								CONSULTAR PROVEEDORES
							</a>
						</td>
						<td>
							<a href="?p=modificar_producto&accion=0" class="btn btn-outline-info btn-lg btn-block">
								CONSULTAR PRODUCTO
							</a>	
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div align="center">
								<div style="width: 50%">
									<a href="?p=buscar_ventas" class="btn btn-outline-info btn-lg btn-block" >
										CONSULTAR VENTAS
									</a>	
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div align="center">
				<table class="table-light" style="display: inline-block; margin-left: 5%; margin-right: 5%; margin-top: 1%">
					<tr>
						<th colspan="2">
							<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
								REGISTROS
							</div>
						</th>
					</tr>
					<tr>
						<td>
							<a href="?p=alta_proveedor" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR PROVEEDOR
							</a>
						</td>
						<td>
							<a href="?p=alta_producto" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR COMPRA
						</td>
					</tr>
					<tr>
						<td>
							<a href="?p=agregar_caracteristica_guante&caracteristica=1" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR MARCA DE GUANTE
							</a>
						</td>
						<td>
							<a href="?p=agregar_caracteristica_guante&caracteristica=2" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR GAMA DE GUANTE
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="?p=agregar_caracteristica_guante&caracteristica=3" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR TALLA DE GUANTE
							</a>
						</td>
						<td>
							<a href="?p=agregar_caracteristica_guante&caracteristica=4" class="btn btn-outline-success btn-lg btn-block">
								REGISTRAR LATEX DE GUANTE
							</a>						
						</td>
					</tr>
				</table>
			</div>

			<div align="center">
				<table class="table-light" style=" margin-left: 5%; margin-right: 5%; width: 47%; margin-top: 1%">
					<tr>
						<th colspan="2">
							<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
								MODIFICAR
							</div>
						</th>
					</tr>
					<tr>
						<td>
							<a href="?p=buscar_proveedor&accion=2" class="btn btn-outline-warning btn-lg btn-block">
								MODIFICAR PROVEEDOR
							</a>
						</td>
						<td>
							<a href="?p=modificar_producto&accion=1" class="btn btn-outline-warning btn-lg btn-block">
								MODIFICAR PRODUCTO
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div align="center">
				<table class="table-light" style=" margin-left: 5%; margin-right: 5%; width: 47%; margin-top: 1%">
					<tr>
						<th colspan="2">
							<div class="badge badge-primary text-wrap" style="width: 100%; height: 30px; padding-top: 10px;">
								ELIMINAR
							</div>
						</th>
					</tr>
					<tr>
						<td>
							<a href="?p=eliminar_usuario" class="btn btn-outline-danger btn-lg btn-block">
							ELIMINAR USUARIO
							</a>
						</td>
						<td width="50%">
							<a href="?p=buscar_proveedor&accion=1" class="btn btn-outline-danger btn-lg btn-block">
							ELIMINAR PROVEEDOR
							</a>
						</td>
					</tr>
					<tr>
						<td width="50%">
							<a href="?p=modificar_producto&accion=2" class="btn btn-outline-danger btn-lg btn-block">
							ELIMINAR PRODUCTO
							</a>
						</td>
						<td>
							<a href="?p=eliminar_caracteristica&caracteristica=1" class="btn btn-outline-danger btn-lg btn-block">
								ELIMINAR MARCA
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="?p=eliminar_caracteristica&caracteristica=2" class="btn btn-outline-danger btn-lg btn-block">
								ELIMINAR GAMA 							
							</a>
						</td>
						<td>
							<a href="?p=eliminar_caracteristica&caracteristica=3" class="btn btn-outline-danger btn-lg btn-block">
								ELIMINAR TALLA
							</a>					
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div align="center">
								<div style="width: 50%">
									<a href="?p=eliminar_caracteristica&caracteristica=4" class="btn btn-outline-danger btn-lg btn-block">
										ELIMINAR LATEX
									</a>	
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
	</body>
	</html>
	<?php
?>