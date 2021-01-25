@extends('plantillas/sistema')
@section('titulo','Inicio | Manager en mi empresa')
@section('contenido')
<div class="p-2">
	<div class="mb-3"><h2>Clientes</h2></div>
	<div class="row">
		<div class="col-sm-8 col-md-10 mb-2">
			<input type="text" id="cliente" class="form-control shadow" placeholder="Escribe nombre del cliente">
		</div>
		<div class="col-sm-4 col-md-2 mb-2">
			<button class="btn btn-primary" onclick="buscar_cliente();">Buscar <i class="fa fa-search icono" id="buscar"></i></button>
		</div>
	</div>
	<div class="p-2" id="resultados-clientes"></div>
</div>
<script>
	document.getElementById('cliente').addEventListener('keyup', function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			buscar_cliente();
		}
	});

	function buscar_cliente(){
		let cliente = document.getElementById('cliente');
		let resultado_clientes = document.getElementById('resultados-clientes');
		let url = base_url+'/clientes/lista?cliente='+encodeURIComponent(cliente.value);

		if(cliente.value == ''){
			resultado_clientes.innerHTML = 'Sin resultados';
		}else{
			xhr.onprogress = function(){
				resultado_clientes.innerHTML = 'Cargando';
			};
			xhr.onload = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					resultado_clientes.innerHTML = this.response;
				}
			};
			xhr.onerror = function(){
				resultado_clientes.innerHTML = 'Error al cargar';
			}
			xhr.open('GET',url,true);
			xhr.send();
		}
	}
</script>
@stop