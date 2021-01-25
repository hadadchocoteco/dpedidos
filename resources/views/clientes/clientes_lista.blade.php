@if(sizeof($clientes) > 0)
	@foreach($clientes as $c)
		<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Razón social</th>
					<th>Descuentos</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $c->razonSocial }}</td>
					<td>{{ $c->porcendescto.' %' }}</td>
					<td><a href="{{ url('pedidos/crear?cliente='.$c->claveCliente) }}"><i class="fa fa-chevron-right"></i></a></td>
				</tr>
			</tbody>
		</table>
		</div>
	@endforeach
@else
	Sin resultados
@endif