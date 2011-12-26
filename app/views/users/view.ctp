<div class="users view">
    
	<h2 id="h2"><?php __('Usuarios');?></h2>
        
    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo('Id.');?></th>
                        <th><?php echo('Nombre de Usuario');?></th>
                        <th><?php echo('Rol');?></th>
			<th class="actions"><?php __('Acciones');?></th>

	</tr>
	
	
	
	
    <td><?php echo $user['User']['id'];?></td>
    <td><?php echo $user['User']['username'];?></td>
    <td><?php echo $user['User']['roles'];?></td>
      
<td class="actions">
<?php if($user['User']['estado']== 1) echo $this->Html->link(__('Editar', true), array('action' => 'edit', $user['User']['id'])); ?>

	<?php if($user['User']['estado']== 1)
echo $this->Html->link(__('Borrar', true), array('action' => 'delete', 
$user['User']['id']), null, sprintf(__('Esta Seguro de eliminar al  usuario N° %s?', true),
$user['User']['id'])); else 
echo $this->Html->link(__('Activar', true), array('action' => 'activar', 
$user['User']['id']), null, sprintf(__('Esta Seguro de volver a Activar al usuario N° %s?', true),
$user['User']['id']));?></td>
    </tr>
    </table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo', true), array('action' => 'add')); ?></li>
                 <li><?php echo $this->Html->link(__('Listar', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li></ul>

	</ul>
</div>