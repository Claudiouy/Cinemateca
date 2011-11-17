<div class="performances index">
    
	<h2 id="h2"><?php __('Funciones');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo('Id.');?></th>
            <th><?php echo('Sala');?></th>
            <th><?php echo('Fecha');?></th>
            <th><?php echo('Comienzo');?></th>
            <th><?php echo('Proyeccion');?></th>
            <th><?php echo('Es Estreno');?></th>
            
            <th class="actions"><?php __('Acciones');?></th>
	</tr>
	
	<tr>
            
<td><?php echo $performance['Performance']['id']; ?>&nbsp;</td>
<td><?php echo $performance['Sala']['name'];?></td>
<td><?php echo $performance['Performance']['fecha']; ?>&nbsp;</td>
<td><?php echo $performance['Performance']['hora_comienzo']; ?>&nbsp;</td>
<td><?php echo $performance['Pelicula']['name']; ?>&nbsp;</td>  
<td><?php echo $performance['Performance']['estreno']; ?>&nbsp;</td>  

<td class="actions">
        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $performance['Performance']['id'])); ?>
	<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $performance['Performance']['id']), null, sprintf(__('Esta Seguro de eliminar la funcion N° %s?', true), $performance['Performance']['id'])); ?>
             
          
        </td>
	</tr>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Nueva Funcion', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Funciones', true), array('action' => 'index'));?></li>
	<li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar Funciones', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
        </ul>
</div>