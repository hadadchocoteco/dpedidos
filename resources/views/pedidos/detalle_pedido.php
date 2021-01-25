<section id="contenido" class="mt-2">
	<?php if(sizeof($detalle) > 0){ ?>
		<table class="table table-sm table-md table-responsive-sm table-responsive-md">
			<thead>
				<th>Clave artículo</th>
				<th>Descripción</th>
				<th>Presentación</th>
				<th>Cantidad</th>
				<th>Precio</th>
			</thead>
			<tbody>
				<?php foreach($detalle as $d){ ?>
				<tr>
					<td><?= $d['claveArticulo']; ?></td>
					<td><?= $d['descripcion']; ?></td>
					<td><?= $d['presentacion']; ?></td>
					<td><?= $d['cantidadArticulo']; ?></td>
					<td><?= $d['precio']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { 
		echo 'Sin pedidos';
	} ?>
</section>