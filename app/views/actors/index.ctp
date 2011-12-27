<div class="index">
	<h2><?php __('Actores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Name');?></th>
                        <th><?php echo $this->Paginator->sort('');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($allActors as $actor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $actor['Actor']['id']; ?>&nbsp;</td>
		<td><?php echo $actor['Actor']['name']; ?>&nbsp;</td>
                <td><?php echo $actor['Actor']['lastname']; ?>&nbsp;</td>
	
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit_actor', $actor['Actor']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'remove_actor', $actor['Actor']['id']), null, sprintf(__('Esta Seguro de eliminar el actor N° %s?', true), $actor['Actor']['id'])); ?>
		</td>
	</tr>
            <?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo actor', true), array('action' => 'new_actor')); ?></li>
	</ul>
</div>

<div style="margin-left:45%;"><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	
