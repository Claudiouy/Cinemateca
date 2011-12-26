<div class="directors index">
    
	<h2 id="h2"><?php __('Directores');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Apellido, Nombre');?></th>
                        <th><?php echo $this->Paginator->sort('Nacionalidad');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($directors as $director):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $director['Director']['surname'].', ';?>
                 <?php echo $director['Director']['name'];?>
                </td>
		<td><?php echo $director['State']['name']; ?>&nbsp;</td>
        <?php echo $this->Form->create('Event'). $this->AutoComplete->input('Event.city'). $this->Form->input('Event.date'). $this->Form->end(__('Search event')) ?>
		<td class="actions">
                        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $director['Director']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $director['Director']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $director['Director']['id']), null, sprintf(__('Esta Seguro de eliminar el director N° %s?', true), $director['Director']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Director', true), array('action' => 'add')); ?></li>
	</ul>
</div>