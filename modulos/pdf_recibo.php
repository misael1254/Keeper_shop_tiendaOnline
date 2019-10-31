<?php 
//5204165410498699
include "../PDF/fpdf.php";
include "clase_carrito.php";
include "../config/config.php";
//$id_cliente = $_GET['id_cliente'];

$carro = new carrito();
$aux= $carro->get_usuario();
$usuario = $aux;

//$usuario = $_SESSION['id'];
$car = $carro->get_car_pdf($usuario);
$conex = mysqli_connect("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");

	$query = "select cliente.nombre_cliente,cliente.ap_paterno,cliente.ap_materno,cliente.cp,cliente.calle,cliente.poblacion_colonia,estado.nombre_estado,municipio.municipio_delegacion,cliente.id_cliente
				from cliente
				inner join usuario on (usuario.nombre_usu = cliente.nombre_usu and cliente.nombre_usu ='$usuario')
				inner join estado on(cliente.id_estado = estado.id_estado)
				inner join municipio on(cliente.id_municipio = municipio.id_municipio and municipio.id_estado = estado.id_estado)";
	$nombre_cliente='';
	$direccion = '';
	$resultado = mysqli_query($conex,$query);
	while ($rows=mysqli_fetch_array($resultado)) {
		$nombre_cliente = $rows[0].' '.$rows[1].' '.$rows[2];
		$direccion = $rows[6].",".$rows[7].". ".$rows[5]." ".$rows[4]." ".$rows[3];
		$id_cliente=$rows[8];
	}
	$query="select (folio_venta) from venta";
	$resultado = mysqli_query($conex,$query);
	$numero = mysqli_num_rows($resultado);
	$folio_venta = $numero + 1;
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFillColor(60,55,55);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(40,7,'NOMBRE:',1,0,'C',true);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(150,7,$nombre_cliente,1,1,'L',false);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(40,7,'DIRECCION:',1,0,'C',true);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(150,7,$direccion,1,1,'L',false);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(40,7,'FOLIO DE VENTA',1,0,'C',true);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(150,7,$folio_venta,1,1,'L',false);
	$pdf->Ln();
	$pdf->SetFillColor(60,55,55);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(190,7,'PRODUCTOS COMPRADOS',1,1,'C',true);
	$pdf->SetFillColor(36,58,190);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,10,'NOMBRE DEL PRODUCTO',1,0,'C',true);
	$pdf->Cell(40,10,'MARCA',1,0,'C',true);
	$pdf->Cell(40,10,'GAMA',1,0,'C',true);
	$pdf->Cell(30,10,'PRECIO',1,0,'C',true);
	$pdf->Cell(30,10,'CANTIDAD',1,0,'C',true);
	$pdf->Ln();
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','B',8);
	$Total = 0;
	foreach($car as $key) {
		$modelo = $key['modelo'];
		$query = "select producto.nombre_producto,marca.marca,gama.gama,producto.precio
					from producto
					inner join marca on (producto.id_marca = marca.id_marca and producto.modelo = '$modelo')
					inner join gama on (producto.id_gama = gama.id_gama)";
		$resultado = mysqli_query($conex,$query);
		$rows=mysqli_fetch_array($resultado);
		$nombre_producto=$rows[0];
		$marca=$rows[1];
		$gama=$rows[2];
		$precio=$rows[3];
		$cantidad=$key['cantidad'];
		$subtotal = $precio * $key['cantidad'];
		$Total += $subtotal;
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50,10,$nombre_producto,1,0,'C',false);
		$pdf->Cell(40,10,$marca,1,0,'C',false);
		$pdf->Cell(40,10,$gama,1,0,'C',false);
		$pdf->Cell(30,10,$precio,1,0,'C',false);
		$pdf->Cell(30,10,$cantidad,1,0,'C',false);
		//$pdf->Cell(40,10,$key['modelo'],1,0,'C',false); // ancho,alto,texto,borde,Ln,Justy,Rellenado
		$pdf->Ln();
		$pdf->SetFillColor(60,55,55);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetX(140);
		$pdf->Cell(30,10,'SUBTOTAL:',1,0,'C',true);
		$pdf->Cell(30,10,'$'.$subtotal,1,1,'C',true);
	}
	/*$TABLAHTML= $carro->get_car_pdf();
	foreach ($TABLAHTML as $key ) {
		$row=''.$key[0];
		//$pdf->Cell(40,10,$row);
	}
	//pdf->Cell(40,10,$carro->get_car_pdf());*/
	//$pdf->Cell(40,10,$TABLAHTML);
	$pdf->SetFillColor(255,0,0);
	$pdf->Ln();
	$pdf->SetX(140);
	$pdf->Cell(30,10,'TOTAL:',1,0,'C',true);
	$pdf->Cell(30,10,'$'.$Total,1,1,'C',true);
	$carro->comprar($id_cliente);
	$pdf->Output();
	//$pdf->Output("Tiket.pdf","D");
?>


