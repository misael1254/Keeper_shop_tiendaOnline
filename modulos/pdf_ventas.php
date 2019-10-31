<?php ;
include "../PDF/fpdf.php";
include "clase_carrito.php";
include "../config/config.php";

$f_i=$_POST['f_i'];
$f_f=$_POST['f_f'];
$Folios = array();
$Productos = array();
$conex = mysqli_connect("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");
$query="select venta.folio_venta,venta.fecha_venta,cliente.nombre_cliente,cliente.ap_paterno,cliente.ap_materno,venta.total from venta 
		inner join cliente on (venta.id_cliente = cliente.id_cliente and venta.fecha_venta between '$f_i' and '$f_f')";
$resultados=mysqli_query($conex,$query);
while ($rows=mysqli_fetch_array($resultados)) {
	$b = array(
		'folio_venta' => $rows[0],
		'fecha_venta' => $rows[1],
		'nombre_cliente' => $rows[2].' '.$rows[3].' '.$rows[4],
		'total' => $rows[5]
	);
	$id = $rows[0];
	$_SESSION['datos'][$id]=$b;
	$Folios=$_SESSION['datos'];
	//$pdf->Cell(190,7,'FOLIO DE VENTA',1,1,'C',true);
	//$pdf->Cell(40,7,'NOMBRE:',1,0,'C',true);
	//$pdf->SetTextColor(0,0,0);

}

 
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',8);

foreach ($Folios as $key) {
	$pdf->SetFillColor(0,0,0);
	$pdf->SetTextColor(255,255,255);
	$folio_venta=$key['folio_venta'];
	$fecha_venta =$key['fecha_venta'];
	$nombre_cliente=$key['nombre_cliente'];
	$total= $key['total'];
	$pdf->Cell(190,7,'FOLIO DE VENTA '.$folio_venta,1,1,'C',true);

	$pdf->SetFillColor(0,0,255);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(130,7,'CLIENTE',1,0,'C',true);
	$pdf->Cell(30,7,'FECHA DE VENTA',1,0,'C',true);
	$pdf->Cell(30,7,'TOTAL',1,1,'C',true);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(130,7,$nombre_cliente,1,0,'C',true);
	$pdf->Cell(30,7,$fecha_venta,1,0,'C',true);
	$pdf->Cell(30,7,$total,1,1,'C',true);

	$pdf->SetFillColor(255,0,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(50,10,'MODELO',1,0,'C',true);
	$pdf->Cell(60,10,'NOMBRE DEL PRODUCTO',1,0,'C',true);
	$pdf->Cell(30,10,'MARCA',1,0,'C',true);
	$pdf->Cell(25,10,'CANTIDAD',1,0,'C',true);
	$pdf->Cell(25,10,'PRECIO P/U',1,1,'C',true);
	
	$query = "select producto_vendido.modelo,producto_vendido.cantidad,producto.nombre_producto, marca.marca,producto.precio
				from producto_vendido
				inner join producto on (producto_vendido.modelo =producto.modelo and producto_vendido.folio_venta = '$folio_venta')
				inner join marca on (producto.id_marca = marca.id_marca)";
	$resultados=mysqli_query($conex,$query);
	while($rows=mysqli_fetch_array($resultados)){
		$b=array(
			'modelo' =>$rows[0],
			'cantidad' =>$rows[1],
			'nombre_producto' =>$rows[2],
			'marca' =>$rows[3],
			'precio' =>$rows[4],
		);
	$id = $rows[0];
	$_SESSION['productos'][$id]=$b;
	}
	$Productos = $_SESSION['productos'];
	unset($_SESSION['productos']);
	
	foreach ($Productos as $key) {
		$modelo=$key['modelo'];
		$cantidad=$key['cantidad'];
		$nombre_producto=$key['nombre_producto'];
		$marca=$key['marca'];
		$precio=$key['precio'];

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(50,10,$modelo,1,0,'C',true);
		$pdf->Cell(60,10,$nombre_producto,1,0,'C',true);
		$pdf->Cell(30,10,$marca,1,0,'C',true);
		$pdf->Cell(25,10,$cantidad,1,0,'C',true);
		$pdf->Cell(25,10,$precio,1,1,'C',true);
	}
	$pdf->Ln();
	$pdf->Ln();
}
  
	
	$pdf->SetFillColor(0,0,0);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(255,255,255);
	//$pdf->Cell(190,7,'FOLIO DE VENTA',1,1,'C',true);
	$pdf->Output();
	unset($_SESSION['datos']);
?>