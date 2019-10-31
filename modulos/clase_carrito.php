<?php 
	class carrito
	{
		public $car = array();
		public $datos_cliente;
		function __construct(){
			if(isset($_SESSION['car'])){
				$this->car = $_SESSION['car'];
			}
			if(isset($_SESSION['datos_cliente'])){
				$this->datos_cliente = $_SESSION['datos_cliente'];
			}
		}

		public function refrescar_carro(){
			self::__construct();
		}

		public function get_conection(){
			$con = new mysqli("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR ConEXIÓN Con SERVIDOR");
			return $con;
		}

		public function get_date(){
			ini_set('date.timezone', 'America/Mexico_City');
			$fecha_compra= date('Y,m,d	',time());
			return $fecha_compra;
		}

		public function add_product($modelo,$cantidad){
			$conection = $this->get_conection();
			$query = "select es_color.existencia,producto.existencia as total
						from es_color
						inner join producto on (producto.modelo = es_color.modelo and producto.modelo = '$modelo')";
			$resultado = mysqli_query($conection,$query);
			$row = mysqli_fetch_array($resultado);
			$limite = $row['existencia'];
			$producto = array(
				'modelo' => $modelo,
				'cantidad' => $cantidad
			);

			if(!empty($this->car)){
				foreach ($this->car as $key) {
					//alert($key['modelo']);
					if($key['modelo'] == $modelo){
						$producto['cantidad'] = $producto['cantidad'] + $key['cantidad'];
						if($producto['cantidad']>$limite){
							$producto['cantidad'] = $limite;
						}
					}
				}
			}
			$id=$modelo;
			$_SESSION['car'][$id] = $producto;
			$this->refrescar_carro();
		}

		public function modify($modelo,$cantidad){
			$conection = $this->get_conection();
			$query = "select es_color.existencia,producto.existencia as total
						from es_color
						inner join producto on (producto.modelo = es_color.modelo and producto.modelo = '$modelo')";
			$resultado = mysqli_query($conection,$query);
			$row = mysqli_fetch_array($resultado);
			$limite = $row['cantidad'];

			$producto = array(
				'modelo' => $modelo,
				'cantidad' => $cantidad
			);
			
			$id=$modelo;
			$_SESSION['car'][$id] = $producto;
			$this->refrescar_carro();
			alert('modificado');
		}

		public function delete_element($modelo){
			foreach ($this->car as $key) {
				if($key['modelo']=$modelo){
					unset($_SESSION['car'][$modelo]);
				}
			}
			$this->refrescar_carro();
			alert('ELIMINADO');
			if(empty($this->car)){
				unset($_SESSION['car']);
			}
		}

		public function get_car(){
			$this->refrescar_carro();
			$html='';
			$aux='';
			$conection = $this->get_conection();
			if(!empty($this->car)){
				//alert('carro');
				foreach($this->car as $key) {
				$modelo= $key['modelo'];
				//alert($modelo);
				$query="select es_color.existencia,es_color.src,producto.precio,producto.nombre_producto
						from es_color
						inner join producto on (producto.modelo = es_color.modelo and producto.modelo = '$modelo')";
					$resultado=mysqli_query($conection,$query);
					$rows=mysqli_fetch_array($resultado);
				$subtotal = $key['cantidad'] * $rows['precio'];
				$html ='<div style="background: #1106F5; width: 75%; margin: 0 auto">
					<table align="center" style="width: 100%" bgcolor="white">
						<tr>
							<td width="50%" style="background-image:url(img/fondo.png);" rowspan="6">
								<div style="width: 50%; margin: 0 auto">
									<img src="'.$rows['src'].'" style="width: 100%">
								</div>
							</td>
							<td >
								<div align="right">
									<strong>NOMBRE DEL PRODUCTO:</strong>
								</div>
							</td>
							<td>
								<span>
									<i class="fas fa-futbol"></i>
									'.$rows['nombre_producto'].'
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<div align="right">
									<strong>PRECIO:</strong>
								</div>
							</td>
							<td>
								<div>
									<span>
									<i class="fas fa-tags"></i>
									'.$rows['precio'].'
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="right">
									<strong>CANTIDAD DISPonIBLE:</strong>
								</div>
							</td>
							<td>
								<div>
									<span>
									<i class="fas fa-smile "></i>
									'.$rows['existencia'].'
									</span>
								</div>
							</td>
						</tr>
						<form action="" method="POST">
						<tr>
							<td>
								<div align="right">
									<span>
										<strong>CANTIDAD A PEDIR:</strong>
									</span>
								</div>
							</td>
							<td>
								<div>
									<span>
						 			<input type="number" name="cantidad" max="'.$rows['existencia'].'" value="'.$key['cantidad'].'" min="1" style="width: 20%; text-align: center; margin:none;">
						 			<input type="hidden" value="'.$key['modelo'].'" name="oculto">
					 			</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="right">
									<span>
										<strong>SUBTOTAL:</strong>
									</span>
								</div>
							</td>
							<td>
								<div>
									<span>
										<i class="fas fa-money-bill fa-spin"></i>
							 			'.$subtotal.'
							 			<i class="fas fa-money-bill fa-spin"></i>					 			
							 		</span>
								</div>
							</td>
						</tr>
						<tr>
							<td width="25%">
								<div>
									<button type="submit" name="act" class="btn btn-warning" style="width: 100%">ACTUALIZAR</button>
								</div>
							</td>
							<td width="90%">
								<div>
									<button type="submit" name="eli" class="btn btn-danger" style="width: 100%">ELIMINAR</button>
								</div>
							</td>
						</tr>
					</form>
					</table>
				</div>
				';$aux = $aux.'<br>'.$html;
				}
				return $aux;
			}
		}

		public function get_total(){
			$conection = $this->get_conection();
			$total =0;
			foreach ($this->car as $key) {
				$modelo= $key['modelo'];
				//alert($modelo);
				$query="select producto.precio from producto where(producto.modelo = '$modelo')";
				$resultado=mysqli_query($conection,$query);
				$rows=mysqli_fetch_array($resultado);
				$suma = $key['cantidad'] * $rows['precio'];
				$total = $total + $suma;
			}
				
			return $total;
		}

		public function comprar($id_cliente){
			if(!empty($this->car)){
				$conection= $this->get_conection();
				$total = $this->get_total();
				$fecha_venta = $this->get_date();
				$consulta_folio_venta="select (folio_venta) from venta";
				$resultado = mysqli_query($conection,$consulta_folio_venta);
				$numero = mysqli_num_rows($resultado);
				$folio_venta=1 + $numero;
				$insertar_venta="insert into venta (folio_venta,fecha_venta,total,id_cliente) values ('$folio_venta','$fecha_venta','$total','$id_cliente')";
				mysqli_query($conection,$insertar_venta);

				foreach ($this->car as $key) {
					$modelo= $key['modelo'];
					$cantidad = $key['cantidad'];
					$query="select producto.precio from producto where(producto.modelo = '$modelo')";
					$resultado=mysqli_query($conection,$query);
					$rows=mysqli_fetch_array($resultado);
					$subtotal = $key['cantidad'] * $rows['precio'];
					$insertar_pro_ven="insert into producto_vendido (folio_venta,modelo,cantidad,subtotal) values ('$folio_venta','$modelo','$cantidad','$subtotal')";
					mysqli_query($conection,$insertar_pro_ven);

					$cuantos_hay="select existencia from es_color where(modelo ='$modelo')";
					$resultado = mysqli_query($conection,$cuantos_hay);
					$rows = mysqli_fetch_array($resultado);
					$existencia = $rows[0]-$cantidad;
					$query = "update es_color set existencia='$existencia' where(modelo='$modelo')";
					mysqli_query($conection,$query);

					$cuantos_hay="select existencia from producto where(modelo ='$modelo')";
					$resultado = mysqli_query($conection,$cuantos_hay);
					$rows = mysqli_fetch_array($resultado);
					$existencia = $rows[0]-$cantidad;
					$query = "update producto set existencia='$existencia' where(modelo='$modelo')";
					mysqli_query($conection,$query);
				}
				//alert("COMPRA EXITOSA");
				unset($_SESSION['car']);
				$this->refrescar_carro();
			}
		}

		public function Save_data_client($id_cliente){
			
			$x= $id_cliente;
			$_SESSION['datos_cliente'] = $x;
			$this->refrescar_carro();
		}

		public function get_usuario(){
			return $this->datos_cliente;
		}

		public function get_car_pdf($usuario){
			return $this->car;
			//return $html;
		}
	}
?>