<div class="performances index">
   
	<h2 id="h2"><?php __('Funciones');?></h2>

<p><?php
echo $paginator->counter(array(
'format' => __('Pag. %page% de %pages%, mostrando %current% registros de %count% en total, comenzando en registro %start%, finalizando en registro %end%', true)
));
?></p>        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('N° Funcion');?></th>
			<th><?php echo $this->Paginator->sort('Sala');?></th>
                        <th><?php echo $this->Paginator->sort('Fecha');?></th>
                        <th><?php echo $this->Paginator->sort('Hora Comienzo');?></th>
                        <th><?php echo $this->Paginator->sort('Proyeccion');?></th>
                        <th><?php echo $this->Paginator->sort('Estreno?');?></th>

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($performances as $performance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<td><?php echo $performance['Performance']['id']; ?>&nbsp;</td>
	<td><?php echo $performance['Sala']['name'];?>&nbsp</td>
        <td><?php echo $performance['Performance']['fecha'];?>&nbsp</td>
	<td><?php echo $performance['Performance']['hora_comienzo']; ?>&nbsp;</td>
        <td><?php echo $performance['Pelicula']['name']; ?>&nbsp;</td>
        <td><?php echo $performance['Performance']['estreno']; ?>&nbsp;</td>
        
		<td class="actions">
		        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $performance['Performance']['id'])); ?>	
                        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $performance['Performance']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $performance['Performance']['id']), null, sprintf(__('Esta Seguro de eliminar la funcion N° %s?', true), $performance['Performance']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

<div><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	
</div>

<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Funcion', true), array('action' => 'add')); ?></li>

                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>