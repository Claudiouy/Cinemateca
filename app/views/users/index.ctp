<div class="usuarios index">
    <h2 id="h2"><?php __('Users');?></h2>
    <?php echo $session->flash('auth');?>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Nombre');?></th>
			<th><?php echo $this->Paginator->sort('Rol');?></th>

                        <th class="actions"><?php __('Acciones');?></th>
	</tr>
 

	<?php

        
        $i = 0;
	foreach ($onlyActive as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['roles']; ?>&nbsp;</td>
	
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Esta Seguro de eliminar el usuario %s?', true), $user['User']['username'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('action' => 'add')); ?></li>
	</ul>
</div>