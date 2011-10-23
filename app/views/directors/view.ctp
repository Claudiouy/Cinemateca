<div class="directors index">
    
	<h2><?php __('Directores');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo('Apellido, Nombre');?></th>
                        <th><?php echo('Nacionalidad');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	
	<tr>
		<td><?php echo $director['Director']['surname'].', ';?>
                 <?php echo $director['Director']['name'];?>
                </td>
                
		<td><?php echo $director['State']['name']; ?>&nbsp;</td>
        
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $director['Director']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $director['Director']['id']), null, sprintf(__('Esta Seguro de eliminar el director N° %s?', true), $director['Director']['id'])); ?>
                                        </td>
	</tr>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Director', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Listar Directores', true), array('action' => 'index'));?></li>
	</ul>
</div>