@extends('plantillas/sistema')
@section('titulo','Inicio | Manager en mi empresa')
@section('contenido')
<div class="p-2">
    <div class="mb-3"><h2>Crear pedido</h2></div>
    <b>Cliente: </b>{{ $cliente->razonSocial }} <br>
    <b>Correo: </b>{{ $cliente->mailmensajes != '' ? $cliente->mailmensajes : 'Sin correo' }} <br>
    <b>Descuento: </b>{{ $cliente->porcendescto }}

    <div class="row mt-4">
		<div class="col-8 col-md-10 mb-2">
			<input type="text" id="articulo" class="form-control" placeholder="Escribe nombre del artículo">
		</div>
		<div class="col-4 col-md-2 mb-2">
			<button class="btn btn-primary" onclick="buscar_articulos();">Buscar <i class="fa fa-search icono" id="buscar"></i></button>
		</div>
    </div>
	<div class="row mt-2">
		<div class="col-12 col-md-12 mb-2 d-grid">
			<input type="button" class="btn btn-info shadow" value="Ver pedido" onclick="cargar_pedido_temporal();" data-bs-toggle="modal" data-bs-target="#modal-pedido-temporal">
		</div>
	</div>
	<form id="forma-busqueda">
		@csrf
		<div id="resultados-articulos">
		</div>
	</form>
</div>
<div class="modal" id="modal-detalle-articulo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="descripcion-completo"></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<span><b>Clave de artículo: </b><span id="clave-articulo-completo"></span></span><br>
				<span><b>Presentación: </b><span id="presentacion-completo"></span></span><br>
				<span><b>Existencia: </b><span id="existencia-completo"></span></span><br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
    function cerrar_contenedor(contenedor){
		let elem_contenedor = document.getElementById(contenedor);
		elem_contenedor.innerHTML = '';
    }

    function buscar_articulos(){
        cerrar_contenedor('resultados-articulos');

		let articulo = document.getElementById('articulo');
		let resultado_articulos = document.getElementById('resultados-articulos');
		let url = base_url+'/articulos/lista?articulo='+encodeURIComponent(articulo.value);

		if(articulo.value == ''){
			resultado_articulos.innerHTML = 'Sin resultados';
		}else{
            xhr.onprocess = function(){
                resultado_articulos.innerHTML = 'Cargando artículos';
            };
			xhr.onload = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					resultado_articulos.innerHTML = this.response;
				}
            };
            xhr.onerror = function(){
                resultado_articulos.innerHTML = 'Error al cargar artículos';
            };
			xhr.open('GET',url,true);
			xhr.send();
		}
	}

	function modal_articulo_detalle(clave_articulo){
		var descripcion = document.getElementById('descripcion_'+clave_articulo);
		var existencia = document.getElementById('existencia_'+clave_articulo);
		var clave_presentacion = document.getElementById('presentacion_'+clave_articulo);

		document.getElementById('descripcion-completo').innerHTML = descripcion.value;
    	document.getElementById('existencia-completo').innerHTML = existencia.value;
    	document.getElementById('clave-articulo-completo').innerHTML = clave_articulo;
    	document.getElementById('presentacion-completo').innerHTML = clave_presentacion.value;
	}

	function seleccion_presentacion(clave_articulo){
		var presentacion = document.getElementById('presentacion_'+clave_articulo);
		var precio = document.getElementById('precio_'+clave_articulo);

		if(presentacion.value > 0 || presentacion.value != ''){
			let url = base_url+'/articulos/consulta/precio?clave_presentacion='+encodeURIComponent(presentacion.value)+'&clave_articulo='+encodeURIComponent(clave_articulo);

			xhr.onload = function(){
	            if (xhr.readyState == 4 && xhr.status == 200) {
	                precio.value = (this.response * <?= ($cliente->porcendescto > 0 ? $cliente->porcendescto : 1); ?>);
	            }
	        };

	        xhr.open('GET',url,true);
	        xhr.send();
		}else{
			document.getElementById('precio_'+clave_articulo).value = '';
			document.getElementById('precio_'+clave_articulo).placeholder = 'Precio';
		}
	}

	function agregar_a_pedido(clave_articulo){
		let forma_busqueda = document.getElementById('forma-busqueda');
		let ivaCliente = Number('{{ $cliente->iva }}');
		let valPresentacion = document.getElementById('presentacion_'+clave_articulo);
		let valPrecio = document.getElementById('precio_'+clave_articulo);
		let valCantidad = document.getElementById('cantidad_'+clave_articulo);
		let valIva = document.getElementById('iva_'+clave_articulo);
		let valIeps = document.getElementById('ieps_'+clave_articulo);
		let valIepsm = document.getElementById('iepsm_'+clave_articulo);
		let _token = document.getElementsByName('_token');
		let url = base_url+'/pedidos/guardar/temporal';
		let datos = new FormData(forma_busqueda);

		var csrf_token = xhr.getResponseHeader(_token[0].value);

		if(valPrecio.value > 0){
			let importe = (valPrecio.value * valCantidad.value).toFixed(2);
			let importeIva = 0;

			if(valIva.value > 0){
				importeIva = (importe * (ivaCliente/100)).toFixed(2);
			}

            datos.append('claveArticulo', clave_articulo);
            datos.append('clavePresentacion', valPresentacion.value);
            datos.append('costo', valPrecio.value);
            datos.append('cantidad', valCantidad.value);
            datos.append('iva', importeIva);
            datos.append('ieps', valIeps.value);
            datos.append('iepsm', valIepsm.value);
            datos.append('claveCliente', '{{ $cliente->claveCliente }}');
            datos.append('porcendescto', '{{ $cliente->porcendescto }}');

			xhr.onload = function(){
		        if (xhr.readyState == 4 && xhr.status == 200) {
		        	if (this.response == 1) {
		        		alert('Artículo agregado al pedido');
		        	}else{
		        		alert('Error al agregar al pedido');
		        	}
		        }
		    };

			xhr.open('POST',url,true);
			xhr.setRequestHeader('x-csrf-token', csrf_token);
		    xhr.send(datos);
		}else{
			alert('El precio del artículo no puede ser 0.');
		}
	}
</script>
@stop