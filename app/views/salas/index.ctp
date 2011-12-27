<div class="salas index">
   
	<h2 id="h2"><?php __('Salas');?></h2>

       
<table cellpadding="0" cellspacing="0">
	<tr>
			  <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Capacidad</th>
                        

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onlyActive as $sala):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<td><?php echo $sala['Sala']['id']; ?>&nbsp;</td>
	<td><?php echo $sala['Sala']['name'];?>&nbsp</td>
        <td><?php echo $sala['Sala']['capacidad'];?>&nbsp</td>
	
        
                        <td class="actions">
                        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $sala['Sala']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $sala['Sala']['id']), null, sprintf(__('Esta Seguro de eliminar la sala N° %s?', true), $sala['Sala']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	


</div>

<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Nueva', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li>
                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>