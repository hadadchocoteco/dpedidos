<?php
$porcendescto = $info[0]['porcendescto'];
$iva = $info[0]['iva'];
$claveCliente = $info[0]['claveCliente'];
$correo = $info[0]['mailmensajes'];
?>
<section id="contenido" class="mt-2">
	<div class="text-dark datos-cliente"><b class="text-dark">Cliente:</b> <?= $info[0]['razonSocial']; ?></div>
	<div class="text-dark datos-cliente"><b class="text-dark">Correo:</b> <?= ($info[0]['mailmensajes'] == '' || $info[0]['mailmensajes'] == NULL ? 'Sin correo' : $info[0]['mailmensajes']); ?></div>
	<div class="text-white text-danger datos-cliente">Descuento <?= number_format($info[0]['porcendescto'],2); ?> %</div>

	<div class="row">
		<div class="col-10 col-md-11 form-group">
			<input type="text" id="articulo" class="form-control forma-redonda shadow" placeholder="Escribe nombre del artículo">
		</div>
		<div class="col-2 col-md-1 form-group">
			<i class="fa fa-search figura" id="buscar" onclick="buscar_articulos();"></i>
		</div>
	</div>
	<div id="espera-articulos">
		<h3>Espere</h3>
		<img src="<?= base_url(); ?>assets/img/sistema/circles-menu-1.gif">
	</div>
	<div class="resultados" id="resultados-articulos"></div>
</section>
<span id="pie">
	<span class="col-12 text-center text-white bg-info forma-redonda" id="tabla-pedido-temporal" data-toggle="modal" data-target="#modal-pedido" onclick="cargar_pedido();">Ver pedido</span>
</span>
<script>
	herramientas.set_class_to_element('espera-articulos','hide','show');

	document.getElementById('articulo').addEventListener('keyup', function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			buscar_articulos();
		}
	});

	function cerrar_contenedor(contenedor){
		let elem_contenedor = document.getElementById(contenedor);

		elem_contenedor.innerHTML = '';
	}

	function modal_detalle(existencia,descripcion,precio_unitario,clave_articulo,clave_presentacion,presentacion){
		document.getElementById('descripcion-completo').innerHTML = descripcion;
    	document.getElementById('existencia-completo').innerHTML = existencia;
    	document.getElementById('clave-completo').innerHTML = clave_articulo;
    	document.getElementById('presentacion-completo').innerHTML = clave_presentacion;
	}

	function buscar_articulos(){
		cerrar_contenedor('resultados-articulos');
		herramientas.set_class_to_element('espera-articulos','show','hide');
		let articulo = document.getElementById('articulo');
		let resultadoArticulos = document.getElementById('resultados-articulos');
		let url = '<?= base_url(); ?>vendedores/a/lista?a='+encodeURIComponent(articulo.value);

		if(articulo.value == ''){
			resultadoArticulos.innerHTML = 'Sin resultados';
		}else{
			xhr.onload = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					herramientas.set_class_to_element('espera-articulos','hide','show');
					resultadoArticulos.innerHTML = this.response;
				}
			};

			/*resultadoArticulos.innerHTML = 'cargando';*/
			xhr.open('GET',url,true);
			xhr.send();
		}
	}

	function agregar_a_pedido(presentacion,precio,cantidad,claveArticulo,iva,ieps,iepsm,idPromo,clavePromo){
		let ivaCliente = Number('<?= $iva; ?>');
		let valPresentacion = document.getElementById(presentacion);
		let valPrecio = document.getElementById(precio);
		let valCantidad = document.getElementById(cantidad);
		let valClaveArticulo = document.getElementById(claveArticulo);
		let valIva = document.getElementById(iva);
		let valIeps = document.getElementById(ieps);
		let valIepsm = document.getElementById(iepsm);
		let valIdPromo = document.getElementById(idPromo);
		let valClavePromo = document.getElementById(clavePromo);
		let url = '<?= base_url(); ?>vendedores/p/agregar/articulo';
		let datos = new FormData();

		if(valPrecio.value > 0){
			let importe = (valPrecio.value * valCantidad.value).toFixed(2);
			let importeIva = 0;

			if(valIva.value > 0){
				importeIva = (importe * (ivaCliente/100)).toFixed(2);
			}

            datos.append('claveArticulo', valClaveArticulo.value);
            datos.append('clavePresentacion', valPresentacion.value);
            datos.append('costo', valPrecio.value);
            datos.append('cantidad', valCantidad.value);
            datos.append('iva', importeIva);
            datos.append('ieps', valIeps.value);
            datos.append('iepsm', valIepsm.value);
            datos.append('claveCliente', <?= $claveCliente; ?>);
            datos.append('porcendescto', <?= $porcendescto; ?>);
            datos.append('idPromo', valIdPromo.value);
            datos.append('clavePromo', valClavePromo.value);

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
		    xhr.send(datos);
		}else{
			alert('El precio del artículo no puede ser 0.');
		}
	}

	function seleccion_presentacion(clave_articulo){
		if(herramientas.get_select_value('presentacion_'+clave_articulo) > 0 || herramientas.get_select_value('presentacion_'+clave_articulo) != ''){
			let presentacion = herramientas.get_select_value('presentacion_'+clave_articulo);
			let url = '<?= base_url(); ?>vendedores/a/consulta/precio?clave_presentacion='+encodeURIComponent(presentacion)+'&clave_articulo='+encodeURIComponent(clave_articulo);

			xhr.onload = function(){
	            if (xhr.readyState == 4 && xhr.status == 200) {
	                document.getElementById('precio_'+clave_articulo).value = (this.response * <?= ($porcendescto > 0 ? $porcendescto : 1); ?>);
	            }
	        };

	        xhr.open('GET',url,true);
	        xhr.send();
		}else{
			document.getElementById('precio_'+clave_articulo).value = '';
			document.getElementById('precio_'+clave_articulo).placeholder = 'Precio';
		}
	}

	function enviar_requisición(){
		let confirmar = confirm('¿Enviar requisición?');
		let comentario = document.getElementById('req-comentario');
		let fecha_respuesta = document.getElementById('fecha-respuesta');
		let correo = document.getElementById('req-correo');
		let moneda = document.getElementById('req-moneda');
		let url = '<?= base_url(); ?>vendedores/p/requisicion/enviar';
		let datos = new FormData();

		datos.append('comentario', comentario.value);
        datos.append('fecha_respuesta', fecha_respuesta.value);
        datos.append('correo', '<?= $correo; ?>');
        datos.append('moneda', moneda.value);
        datos.append('cliente', '<?= $claveCliente; ?>');

		if (confirmar) {
		    xhr.onload = function(){
		        if (xhr.readyState == 4 && xhr.status == 200) {
		            if (this.response == 1) {
		            	comentario.value = '';
		            	fecha_respuesta.value = '';
		            	moneda.value = 1;
		            	alert('Requisición enviada');
		            }
		        }
		    };

		    xhr.open('POST',url,true);
		    xhr.send(datos);
		}
	}
</script>