<div class="performances index">
    
	<h2 id="h2"><?php __('Funciones');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo('No. Id..');?></th>
            <th><?php echo('Sala');?></th>
            <th><?php echo('Fecha');?></th>
            <th><?php echo('Comienzo');?></th>
            <th><?php echo('Proyeccion');?></th>
            <th><?php echo('Precio');?></th>
            
            <th class="actions"><?php __('Acciones');?></th>
	</tr>
	
	<tr>
            
<td><?php echo $performance['Performance']['id']; ?>&nbsp;</td>
<td><?php echo $performance['Sala']['name'];?></td>
<td><?php echo $performance['Performance']['fecha']; ?>&nbsp;</td>
<td><?php echo $performance['Performance']['hora_comienzo']; ?>&nbsp;</td>
<td><?php echo $performance['Pelicula']['name']; ?>&nbsp;</td>  
<td><?php echo $performance['Performance']['precio']; ?> $U &nbsp;</td>  
  

<td class="actions">
<?php if($performance['Performance']['estado']== 1) echo $this->Html->link(__('Editar', true), array('action' => 'edit', $performance['Performance']['id'])); ?>

	<?php if($performance['Performance']['estado']== 1)
echo $this->Html->link(__('Borrar', true), array('action' => 'delete', 
$performance['Performance']['id']), null, sprintf(__('Esta Seguro de eliminar la funcion N° %s?', true),
$performance['Performance']['id'])); else 
echo $this->Html->link(__('Activar', true), array('action' => 'activar', 
$performance['Performance']['id']), null, sprintf(__('Esta Seguro de volver a Activar la funcion N° %s?', true),
$performance['Performance']['id']));?></td>
     
          
        </td>
	</tr>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Nueva Funcion', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Funciones', true), array('action' => 'index'));?></li>
	<li><?php echo $this->Html->link(__('Menu Principal', true), array('controller'=>'pages','action' => 'home'));?></li></ul>

        <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
        </ul>
</div>