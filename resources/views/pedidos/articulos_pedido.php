<?php if (sizeof($articulosTemp) > 0) { ?>
	<div class="ventana-resultado">
		<h4 align="center">Pedido actual</h4>
		<div class="d-flex flex-row-reverse">
			<div class="p-2 mr-1 ml-1 bd-highlight"><span onclick="eliminar_pedido($_SESSION['USUARIO']['ID_USUARIO']);">Eliminar pedido</span></div>
		</div>
		<table class="table table-sm table-md table-responsive-sm table-responsive-md">
			<thead>
				<th>Acciones</th>
				<th>Clave</th>
				<th>Artículo</th>
				<th>Cant.</th>
				<th>Descripción</th>
				<th>Importe</th>
			</thead>
			<tbody>
				<?php foreach ($articulosTemp as $at) { 
					$ca = $at['claveArticulo'];
					?>
					<tr>
						<td><span class="material-icons pointer" onclick="eliminar_articulo(<?= $ca; ?>,<?= $_SESSION['ID_USUARIO']; ?>);">delete</span></td>
						<td><?= $at['claveArticulo']; ?></td>
						<td><?= $at['nombreArticulo']; ?></td>
						<td><?= $at['cantidad']; ?></td>
						<td><?= $at['descripcion']; ?></td>
						<td><?= $at['costo']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php
			$total = $totalesPedido[0]['sumaCosto'] + $totalesPedido[0]['sumaIva'] + $totalesPedido[0]['sumaIeps'];
			$total = $total * 1.00;
		?>
		<div align="right" style="font-size: .7em;">
			<hr>
			<label><b>Subtotal:</b> <?= $totalesPedido[0]['sumaCosto']; ?></label><br>
			<label><b>IVA:</b> <?= $totalesPedido[0]['sumaIva']; ?></label><br>
			<label><b>IEPS:</b> <?= $totalesPedido[0]['sumaIeps']; ?></label><br>
			<label><b>Total:</b> <?= $total; ?></label>
		</div>
		<div class="d-flex flex-row justify-content-center">
			<div class="p-2 mr-1 ml-1 bd-highlight bg-info text-white" onclick="cotizar_pagar('c');">Cotizar</div>
  			<div class="p-2 mr-1 ml-1 bd-highlight bg-primary text-white" onclick="cotizar_pagar('p');">Pedir</div>
		</div>
	</div>
<?php } else {
	echo 'Sin resultados';
}?>