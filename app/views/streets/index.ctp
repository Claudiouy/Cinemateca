<div class="streets index">
    
	<h2><?php __('Calles');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Id');?></th>
                        <th><?php echo $this->Paginator->sort('Nombre');?></th>

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($misstreets as $street):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $street['Street']['id'];?>
                </td>

            <td><?php echo $street['Street']['name'];?>
                </td>
        
		<td class="actions">
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