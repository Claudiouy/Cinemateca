<div class="socios index">
    
	<h2><?php __('Socios');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('N° Socio');?></th>
			<th><?php echo $this->Paginator->sort('Apellido, Nombre');?></th>
                        <th><?php echo $this->Paginator->sort('Doc. Identidad');?></th>
                        <th><?php echo $this->Paginator->sort('Suscripcion');?></th>
                        <th><?php echo $this->Paginator->sort('Forma de Pago');?></th>

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onlyActive as $socio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $socio['Socio']['id']; ?>&nbsp;</td>
		<td><?php echo $socio['Socio']['surname'].', ';?>
                 <?php echo $socio['Socio']['name'];?>
                </td>
	<td><?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>
        	<td><?php echo $socio['Suscription']['name']; ?>&nbsp;</td>
<td><?php echo $socio['PaymentMethod']['name']; ?>&nbsp;</td>
        
		<td class="actions">
		        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $socio['Socio']['id'])); ?>	
                        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $socio['Socio']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $socio['Socio']['id']), null, sprintf(__('Esta Seguro de eliminar el Socio N° %s?', true), $socio['Socio']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Socio', true), array('action' => 'add')); ?></li>
	</ul>
</div>