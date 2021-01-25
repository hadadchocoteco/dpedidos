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
			<input type="text" id="articulo" class="form-control shadow" placeholder="Escribe nombre del artículo">
		</div>
		<div class="col-4 col-md-2 mb-2">
			<button class="btn btn-primary" onclick="buscar_articulos();">Buscar <i class="fa fa-search icono" id="buscar"></i></button>
		</div>
    </div>
    <div id="resultados-articulos"></div>
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
</script>
@stop