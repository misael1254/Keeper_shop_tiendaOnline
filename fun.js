function prueba(){
	alert('');
	opcion=1;
	switch(opcion){
		case 1:{
			alert('andala osa');
		}
	}
}
function prueba_2(){
	alert('prueba_2');
	var checkbox =document.getElementById('n_ga');
	checkbox.focus();

}
function limpiar(ID,opcion){
	alert('limpiar');
	 var checkbox = document.getElementById(ID);
	 var campo;
	 switch(opcion){
	 	case 1:{
	 		if(checkbox.checked){
	 			campo = document.getElementById('c_color');
	 			campo.disabled = true;
	 			campo.value="";
	 		}else{
	 			campo = document.getElementById('c_color');
	 			campo.disabled = false;
	 		}
	 		break;
	 	}
	 }
}
function habilitar(){
	//alert('ayay');
	var x = document.getElementById('precio_uni');
	var y = document.getElementById('cantidad');
	if(x.value == ""){
		y.disabled=true;
	}
	else{
		y.disabled=false;
	}
}

function calcular(){
	//alert('calcular');
	var x = document.getElementById('precio_uni');
	var y = document.getElementById('cantidad');
	var z = document.getElementById('sub_total');
	z.value = (x.value * y.value);
}
function sumar(){
	var total = document.getElementById('id_total');
}
function validar_num(e){
	key = e.keyCode || e.which;
	teclado = String.fromCharCode(key);
	numeros="0123456789";
	especiales = "8-37-38-46";
	teclado_especial = false;
	for(var i in especiales){
		if(key==especiales[i]){
			teclado_especial=true;
		}
	}
	if(numeros.indexOf(teclado)==-1 && !teclado_especial){
		return false;
	}
}
function act(sum,max){
	var x = document.getElementById('can_id');
	valor = parseInt(x.value, 10);
	if(sum == 'restar'){
		valor -= 1;
		x.value = valor;
	}
	else{
		valor += 1;
		x.value = valor;
	}	
	if(valor > max){
		x.value = max;
	}
	if(valor == 0){
		x.value = 1;
	}
	if(x.value == "NaN"){
		x.value = 1;
	}
}

function CargaMunicipios(estado,ya_tiene)
{
	var id_estado=estado;
	var id_mun = ya_tiene;
	//alert(id_estado);
	//alert(id_mun);
	$.ajax(
	{
		type: 'POST',
		url: 'modulos/municipios.php',
		data: {id:id_estado,
				id_muni:id_mun},
		success:function(datos)
		{
		  $('#MUNICIPIO').find('option').remove();
		  $('#MUNICIPIO').append(datos);
		  //alert(datos);
		} 
	}
	);
}

function CargarProducto(modelo,accion){

	var imodelo = modelo;
	var iaccion = accion;
	$.ajax(
	{
		type: 'POST',
		url: 'modulos/modi_producto.php',
		data: {modelo:imodelo,
				accion:iaccion},
		success:function(datos)
		{
			//alert(datos);
			$('#divsito').find('table').remove();
			$('#divsito').append(datos);
		}
	}
	);
}


function cargar_proveedor(rfc,accion){
	var RFC = rfc;
	var Accion = accion;
	$.ajax(
	{
		type: 'POST',
		url: 'modulos/datos_proveedor.php',
		data: {rfc: RFC,
				accion: Accion},
		success:function(datos)
		{
			//alert(datos);
			$('#divsito').find('table').remove();
			$('#divsito').append(datos);
		}
	}
	);
}


function cargar_venta(Fecha_ini,Fecha_fin){
	var F_I = Fecha_ini;
	var F_F = Fecha_fin;
	//alert(F_F);
	$.ajax(
	{
		type: 'POST',
		url: 'modulos/ventas_hechas.php',
		data: {f_i: F_I,
				f_f: F_F},
		success:function(datos)
		{
			//alert(datos);
			$('#divsito').find('table').remove();
			$('#divsito').append(datos);
		}
	}
	);
}

function actualizar_proveedor(rfc){
	var RFC = rfc;
	$.ajax(
	{
		type: 'POST',
		url: 'modulos/campos_proveedor_aux.php',
		data: {rfc: RFC},
		success:function(datos)
		{
			//alert(datos);
			$('#divsito').find('table').remove();
			$('#divsito').append(datos);
		}
	}
	);
}

function comprobar_tarjeta(){
	
}