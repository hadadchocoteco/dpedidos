<?php if(sizeof($historial) > 0){ ?>
	<table class="table table-xs table-md table-responsive-xs table-responsive-md table-borderless">
		<thead>
			<th>Folio</th>
			<th>Tipo</th>
			<th>Cliente</th>
			<th>Total</th>
			<th>Estado</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach($historial as $h){ ?>
			<tr class="border-top">
				<td><?= $h['folio']; ?></td>
				<td><?= ($h['documento'] == 'r' ? 'Requisición' : ($h['documento'] == 'p' ? 'Pedido' : ($h['documento'] == 'c' ? 'Cotización' : ''))); ?></td>
				<td><?= $h['razonSocial']; ?></td>
				<td><?= $h['total']; ?></td>
				<td><?= $h['estado']; ?></td>
				<td>
					<?php if($h['documento'] != 'r'){ ?>
						<i class="fa fa-info figura" onclick="sistema.redireccionar('vendedores/p/historial/detalle?folio='+encodeURIComponent(<?= $h['folio']; ?>));"></i>
					<?php } ?>
				</td>
			</tr>
			<?php if($h['documento'] == 'r'){ ?>
				<tr>
					<td></td>
					<td colspan="5"><?= '<b>Comentario:</b> '.$h['mensaje'].'<br> <b>Fecha de respuesta</b>: '.$h['fechaRespuestaReq']; ?></td>
				</tr>
			<?php } 
			}?>
		</tbody>
	</table>
<?php } else { 
	echo 'Sin detalles';
} ?>