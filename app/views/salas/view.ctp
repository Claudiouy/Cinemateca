<div class="salas index">
    
	<h2 id="h2"><?php __('Salas');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo('No. Id..');?></th>
            <th><?php echo('Sala');?></th>
            <th><?php echo('Capacidad');?></th>

            
            <th class="actions"><?php __('Acciones');?></th>
	</tr>
	
	<tr>
            
<td><?php echo $sala['Sala']['id']; ?>&nbsp;</td>
<td><?php echo $sala['Sala']['name'];?></td>
<td><?php echo $sala['Sala']['capacidad']; ?>&nbsp;</td>

  

<td class="actions">
<?php if($sala['Sala']['estado']== 1) echo $this->Html->link(__('Editar', true), array('action' => 'edit', $sala['Sala']['id'])); ?>

	<?php if($sala['Sala']['estado']== 1)
echo $this->Html->link(__('Borrar', true), array('action' => 'delete', 
$sala['Sala']['id']), null, sprintf(__('Esta Seguro de eliminar la sala N° %s?', true),
$sala['Sala']['id'])); else 
echo $this->Html->link(__('Activar', true), array('action' => 'activar', 
$sala['Sala']['id']), null, sprintf(__('Esta Seguro de volver a Activar la sala N° %s?', true),
$sala['Sala']['id']));?></td>
     
          
        </td>
	</tr>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Nueva Funcion', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Salas', true), array('action' => 'index'));?></li>
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