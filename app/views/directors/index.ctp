<div class="directors index">
    
<h2 id="h2"><?php __('Directores');?></h2>
<?php echo $session->flash('auth');?>

 <p><?php
echo $paginator->counter(array(
'format' => __('Pag. %page% de %pages%, mostrando %current% registros de %count% en total, comenzando en registro %start%, finalizando en registro %end%', true)
));
?></p>         
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Apellido, Nombre');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onlyActive as $director):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $director['Director']['surname'].', ';?>
                 <?php echo $director['Director']['name'];?>
                </td>
           		<td class="actions">

                        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $director['Director']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $director['Director']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $director['Director']['id']), null, sprintf(__('Esta Seguro de eliminar el director N° %s?', true), $director['Director']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'display', 'home'));?></li>

	</ul>
</div>