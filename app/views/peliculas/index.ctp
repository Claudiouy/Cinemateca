<div class="index">

	<h2 id="h2"><?php __('Peliculas');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('título');?></th>
                        <th><?php echo $this->Paginator->sort('duración');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($peliculas as $peli):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $peli['Pelicula']['id']; ?>&nbsp;</td>
		<td><?php echo $peli['Pelicula']['name']; ?>&nbsp;</td>
                <td><?php echo $peli['Pelicula']['duracion']; ?> min &nbsp;</td>
	
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'editar_pelicula', $peli['Pelicula']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'eliminar_pelicula', $peli['Pelicula']['id']), null, sprintf(__('Esta Seguro de eliminar la película N° %s?', true), $peli['Pelicula']['id'])); ?>
		</td>
	</tr>
            <?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva película', true), array('action' => 'nueva_pelicula')); ?></li>
                <li><?php echo $this->Html->link(__('Activar películas', true), array('action' => 'seleccionar_peliculas')); ?></li>
                <input type="button" value="Cargar peliculas" id="showTemplateBut" />
        </ul>
        
</div>