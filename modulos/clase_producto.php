<?php 
	class producto
	{
		public $carro = array();
		function __construct()
		{
			if(isset($_SESSION['carro'])){
				$this->carro = $_SESSION['carro'];
			}
		}

		public function agregar_producto($modelo,$nombre_producto,$marca,$gama,$latex,$color,$talla,$imagen,$precio,$cantidad,$subtotal){

			$producto = array(
				'modelo' => $modelo,
				'nombre_producto' => $nombre_producto,
				'marca' => $marca,
				'gama' => $gama,
				'latex' => $latex,
				'color' => $color,
				'talla' => $talla,
				'imagen' => $imagen,
				'precio' => $precio,
				'cantidad' => $cantidad,
				'subtotal' => $subtotal
			);
			if(!empty($this->carro)){
				foreach ($this->carro as $key) {
					if(($key['modelo']==$modelo and $key['color'] == $color)){
						$producto['modelo'] = $key['modelo'];
						$producto['nombre_producto'] = $key['nombre_producto'];
						$producto['marca'] = $key['marca'];
						$producto['gama'] = $key['gama'];
						$producto['latex'] = $key['latex'];
						$producto['color'] = $key['color'];
						$producto['talla'] = $key['talla'];
						$producto['imagen'] = $key['imagen'];
						$producto['precio'] = $key['precio'];
						$producto['cantidad'] = $key['cantidad'] + $producto['cantidad'];
						$producto['subtotal'] = $producto['precio'] * $producto['cantidad'];
					}
				}
			}
			$id = $modelo;
			$_SESSION['carro'][$id]= $producto;
			$this->actualizar_carro();
		}

		public function actualizar_carro(){
			self::__construct();
		}

		public function obtener_productos(){
			$html ='';
			if(!empty($this->carro)){
				foreach ($this->carro as $key) {
					$html.='<div style="color:#FFFFFF">'.$key['modelo'].'<br>'
					.$key['nombre_producto'].'<br>'
					.$key['marca'].'<br>'
					.$key['gama'].'<br>'
					.$key['latex'].'<br>'
					.$key['color'].'<br>'
					.$key['talla'].'<br>'
					.$key['imagen'].'<br>'
					.$key['precio'].'<br>'
					.$key['cantidad'].'<br>'
					.$key['subtotal'].'<br> </div>';
				}
			}
			return $html;
			//return $this->carro;
		}

		public function eliminar_producto($modelo,$color){
			if(!empty($this->carro)){
				foreach ($this->carro as $key) {
					if(($key['modelo']==$modelo and $key['color'] == $color)){
						unset($_SESSION['carro'][$modelo]);
						return true;
					}
				}
			}else{
				return false;
			}
			$this->actualizar_carro();
		}

		public function insertar_compra($RFC,$tipo_pago,$total){
			$conex= $this->get_conex();
			if(!empty($this->carro)){
				$query = "select (folio_compra) from compra";
				$resultado = mysqli_query($conex,$query); //BUSCAR COMPRA
				$numero=mysqli_num_rows($resultado);
				$row=mysqli_fetch_array($resultado);
				$folio_compra=1 + $numero;
				if($row[0]==$folio_compra){ //COMPRA ESTÁ
					alert('EL FOLIO DE LA COMPRA YA EXISTE');
					//return false;
				}else{
					//COMPRA NO ESTÁ

					$fecha_compra = $this->get_fecha();
					$resultado = mysqli_query($conex, "select rfc from proveedor where(rfc = '$RFC')")or die ("ERROR AL BUSCAR PROVEEDOR"); //BUSCO AL PROVEEDOR
					if(mysqli_num_rows($resultado)>0){
						//EL PROVEEDOR ESTÁ
					   mysqli_query($conex,"insert into compra (folio_compra,fecha_compra,tipo_pago,total) values('$folio_compra','$fecha_compra','$tipo_pago','$total')") or die ("ERROR AL INSERTAR EN COMPRA");//INSERTO LA COMPRA
					   		//INSERTAR EN TABLA PROVEE
					   	 mysqli_query($conex,"insert into provee (rfc,folio_compra) values('$RFC','$folio_compra')") or die ("ERROR AL INSERTAR EN PROVEE");


					   foreach ($this->carro as $key) { //PARA CADA ROW DEL CARRO
					   		$mode; 
					   		$cantidad_total;
					   		$id_color;
					   		$existencia;
					   		$aux2 = $key['modelo'];
					   		$src;
					   		$resultado = mysqli_query($conex, "select modelo,existencia from producto where(modelo = '$aux2')") or die ('error al consultar modelo');
					   		if(mysqli_num_rows($resultado)>0){//EL PRODUCTO ESTÁ
					   			alert('EL PRODUCTO ESTÁ');
					   			$aux = mysqli_fetch_array($resultado);
					   			$mode= $aux[0];
					   			$cantidad_total = $aux[1];
					   			$aux2 =$key['color'];
					   			$resultado = mysqli_query($conex, "select id_color from color where(color = '$aux2')") or die ('error al consultar color'); //BUSCO COLOR
					   			if(mysqli_num_rows($resultado)>0){
					   				//SI EL COLOR ESTÁ
					   				alert('EL COLOR ESTÁ');
					   				$aux = mysqli_fetch_array($resultado);
					   				$id_color = $aux[0];
					   				$resultado = mysqli_query($conex, "select existencia from es_color where(id_color = '$id_color' and modelo = '$mode')") or die ('error al consultar color y modelo');
					   				if(mysqli_num_rows($resultado)>0){
					   					$aux = mysqli_fetch_array($resultado);
					   					$existencia = $aux[0];
					   					$existencia = $existencia + $key['cantidad'];
					   					$cantidad_total = $cantidad_total + $key['cantidad'];
					   					mysqli_query($conex, "update es_color set existencia='$existencia' where(id_color = '$id_color' and modelo = '$mode')") or die ('error al actualizar existencia ES COLOR');
					   					mysqli_query($conex, "update producto set existencia='$cantidad_total' where(modelo = '$mode')") or die ('error al actualizar existencia TOTAL');
					   					alert('EL PRODUCTO FUE REGISTRADO EXITOSAMENTE');
					   					alert('EL MODELO YA ESTABA DENTRO DE LA BASE DE DATOS, MODIFIQUE SU PRECIO EN EL APARTADO DE _MODIFICAR_');
					   				}
					   			}
					   			else{
					   				//EL COLOR ES NUEVO
					   				$resultado = mysqli_query($conex, "select max(id_color) from color") or die ('error al consultar  max color');
					   				$aux = mysqli_fetch_array($resultado);
					   				$id_color = $aux[0];
					   				$id_color = $id_color + 1;
					   				alert($id_color);
					   				$cantidad_total = $cantidad_total + $key['cantidad'];
					   				//$aux2 vale el color
					   				$src= $key['imagen'];

					   				mysqli_query($conex,"insert into color (id_color,color) values('$id_color','$aux2')") or die ("ERROR AL INSERTAR EN NUEVO COLOR");
					   				mysqli_query($conex, "update producto set existencia='$cantidad_total' where(modelo = '$mode')") or die ('error al actualizar existencia TOTAL');
					   				$aux2 = $key['cantidad'];

					   				alert($id_color.''.$mode.''.$aux2.''.$src);
					   				mysqli_query($conex,"insert into es_color (id_color,modelo,existencia,src) values('$id_color','$mode','$aux2','$src')") or die ("ERROR AL INSERTAR EN ES_COLOR");
					   				alert('EL PRODUCTO FUE REGISTRADO EXITOSAMENTE');
					   				alert('EL MODELO YA ESTABA DENTRO DE LA BASE DE DATOS, MODIFIQUE SU PRECIO EN EL APARTADO DE _MODIFICAR_');
					   			}

					   		}
					   		else{

					   			//EL PRODUCTO ES NUEVO
					   			$modelo = $key['modelo'];
								$nombre_producto = $key['nombre_producto'];
								$marca = $key['marca'];
								$gama = $key['gama'];
								$latex = $key['latex'];
								$color = $key['color'];
								$talla = $key['talla'];
								$imagen = $key['imagen'];
								$precio = $key['precio'];
								$cantidad = $key['cantidad'];
								$subtotal = $key['subtotal'];
								//alert('producto NUEVO');
								//alert(''.$modelo.''.$cantidad.','.$nombre_producto.','.$precio.','.$marca.','.$talla.','.$gama.','.$latex);
					   			//EL PRODUCTO ES NUEVO
					   			mysqli_query($conex,"insert into producto (modelo,existencia,nombre_producto,precio,id_marca,id_talla,id_gama,id_latex) values('$modelo','$cantidad','$nombre_producto','$precio','$marca','$talla','$gama','$latex')") or die ("ERROR AL INSERTAR EN NUEVO PRODUCTO");
					   			alert('PRODUCTO AGREGADO');

					   			$resultado = mysqli_query($conex, "select id_color from color where(color = '$color')") or die ('error al consultar color'); //BUSCO COLOR
					   			if(mysqli_num_rows($resultado)>0){
					   				//SI EL COLOR ESTÁ
					   				//alert('EL COLOR ESTÁ');
					   				$aux = mysqli_fetch_array($resultado);
					   				$id_color = $aux[0];

						   			//ES_COLOR
						   			mysqli_query($conex,"insert into es_color (id_color,modelo,existencia,src) values('$id_color','$modelo','$cantidad','$imagen')") or die ("ERROR AL INSERTAR EN ES_COLOR");
						   			//alert('ES_COLOR');
					   			}
					   			else{
						   			//EL COLOR ES NUEVO
						   				$resultado = mysqli_query($conex, "select max(id_color) from color") or die ('error al consultar  max color');
						   				$aux = mysqli_fetch_array($resultado);
						   				$id_color = $aux[0];
						   				$id_color = $id_color + 1;
						   				mysqli_query($conex,"insert into color (id_color,color) values('$id_color','$color')") or die ("ERROR AL INSERTAR EN NUEVO COLOR");
						   				//alert('color agregado');

						   			//ES_COLOR
						   			mysqli_query($conex,"insert into es_color (id_color,modelo,existencia,src) values('$id_color','$modelo','$cantidad','$imagen')") or die ("ERROR AL INSERTAR EN ES_COLOR");
						   			//alert('ES_COLOR');
					   			}
					   		}

					   	//ADQUIRIR PRODUCTO
					   	$modelo = $key['modelo'];
						$cantidad = $key['cantidad'];
						$subtotal = $key['subtotal'];
					   //	alert($modelo.''.$folio_compra.' '.$cantidad.' '.$subtotal);
					   	mysqli_query($conex,"insert into adquirir_productos(modelo,folio_compra,cantidad,subtotal) values('$modelo','$folio_compra','$cantidad','$subtotal')") or die ("ERROR AL INSERTAR EN ADQUIRIR_PRODUCTO");
					   //	alert('ADQUIRIR_PRODUCTO');
					   	$this->limpiar_carro();
					   }

					}
					else{//PROVEEDOR NO ESTÁ
						alert('TIENES QUE DAR DE ALTA AL PROVEEDOR');
					}
				}
					
			}
		}
		public function get_carro(){
			$this->actualizar_carro();
			if(!empty($this->carro)){
				return $this->carro;
			}
			else{
				return 0;
			}
		}

		public function get_fecha(){
			ini_set('date.timezone', 'America/Mexico_City');
			$fecha_compra= date('Y,m,d	',time());
			return $fecha_compra;
		}

		public function get_conex(){
			$con = new mysqli("localhost","id9607576_misael1254","escom1297","id9607576_tienda")or die("ERROR CONEXIÓN CON SERVIDOR");
			return $con;
		}

		public function vaciar(){
				if(isset($_SESSION['carro'])){
					foreach ($this->carro as $key) {
						$ruta = $key['imagen'];
						unlink($ruta); 
					}
				unset($_SESSION['carro']);
				
				$this->actualizar_carro();
				}
			
			
		}
		public function limpiar_carro(){
			unset($_SESSION['carro']);
				
				$this->actualizar_carro();
		}
	}
?>