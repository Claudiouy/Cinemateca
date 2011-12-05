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
                        <th><?php echo $this->Paginator->sort('Activa');?></th>

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
        <td><?php if($performance['Performance']['estreno']== 1) echo "SI"; else echo "NO";?></td>
        <td><?php if($performance['Performance']['estado']== 1) echo "SI"; else echo "NO";?></td>
        
		<td class="actions">
		        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $performance['Performance']['id'])); ?>	
<?php if($performance['Performance']['estado']== 1)
echo $this->Html->link(__('Borrar', true), array('action' => 'delete', 
$performance['Performance']['id']), null, sprintf(__('Esta Seguro de eliminar la funcion N° %s?', true),
$performance['Performance']['id'])); else echo $this->Html->link(__('Activar', true), array('action' => 'activar', 
$performance['Performance']['id']), null, sprintf(__('Esta Seguro de volver a Activar la funcion N° %s?', true),
$performance['Performance']['id']));?></td>

			
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