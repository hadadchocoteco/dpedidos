<?php if (sizeof($articulos_temp) > 0) { ?>
	<div class="ventana-resultado">
		<h4 align="center">Pedido actual</h4>
		<div class="d-flex flex-row-reverse form-group">
			<div>
				<button class="btn btn-danger forma-redonda shadow" onclick="eliminar_pedido();"><i class="fas fa-trash-alt"></i> Eliminar pedido</button>
			</div>
		</div>
		<table class="table table-sm table-md table-responsive-sm table-responsive-md">
			<thead>
				<th>Acciones</th>
				<th>Clave</th>
				<th>Descripción</th>
				<th>Cant.</th>
				<th>Importe</th>
			</thead>
			<tbody>
				<?php foreach ($articulos_temp as $at) {
					$ca = $at['claveArticulo']; ?>
					<tr>
						<td><span class="material-icons pointer" onclick="eliminar_articulo('<?= $ca; ?>','carga-pedido');">delete</span></td>
						<td><?= $at['claveArticulo']; ?></td>
						<td><?= $at['descripcion']; ?></td>
						<td><?= $at['cantidad']; ?></td>
						<td><?= $at['costo']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php
			$total = $totales_pedido[0]['sumaCosto'] + $totales_pedido[0]['sumaIva'] + $totales_pedido[0]['sumaIeps'];
			$total = $total * 1.00;
		?>
		<div align="right" class="bg-light p-2">			
			<label><b>Subtotal:</b> <?= $totales_pedido[0]['sumaCosto']; ?></label><br>
			<label><b>IVA:</b> <?= $totales_pedido[0]['sumaIva']; ?></label><br>
			<label><b>IEPS:</b> <?= $totales_pedido[0]['sumaIeps']; ?></label><br>
			<label><b>Total:</b> <?= $total; ?></label>
		</div>
		<div class="d-flex flex-row-reverse">
			<div class="p-2">
				<button class="p-2 btn btn-info text-white forma-redonda" onclick="cotizar_pagar('c');" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off><i class="fas fa-clipboard-list"></i> Cotizar</button>
			</div>
			<div class="p-2">
  				<button class="p-2 btn btn-primary text-white forma-redonda" onclick="cotizar_pagar('p');" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off><i class="fas fa-file-invoice-dollar"></i> Pedir</button>
  			</div>
		</div>
	</div>
<?php } else {
	echo 'Sin resultados';
}?>