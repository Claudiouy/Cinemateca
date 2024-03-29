<?php ini_set('memory_limit','256M');?>
<div class="socios form">
<h2 id="h2"><?php __('Socios');?></h2>
<p><?php
echo $paginator->counter(array(
'format' => __('Pag. %page% de %pages%, mostrando %current% registros de %count% en total, comenzando en registro %start%, finalizando en registro %end%', true)
));
?></p>        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('N° Socio');?></th>
			<th><?php echo $this->Paginator->sort('Apellido, Nombre');?></th>
                        <th><?php echo $this->Paginator->sort('Doc. Identidad');?></th>
                        <th><?php echo $this->Paginator->sort('Estado');?></th>

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
        

	foreach ($socios as $socio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}?>
<tr<?php echo $class;?>>
<td><?php echo $socio['Socio']['id']; ?>&nbsp;</td>
<td><?php echo $socio['Socio']['surname'].', ';?><?php echo $socio['Socio']['name'];?></td>
<td><?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>
<td><?php if($socio['Socio']['estado']== 1) echo "ACTIVO"; else echo "DE BAJA";?></td>
<td class="actions">
    <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $socio['Socio']['id'])); ?>	
    <?php if($socio['Socio']['estado']== 1)echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $socio['Socio']['id']), null, sprintf(__('Esta Seguro de eliminar el Socio N° %s?', true), $socio['Socio']['id'])); ?>
    <?php if($socio['Socio']['estado']== 1)echo $this->Html->link(__('Editar', true), array('action' => 'edit', $socio['Socio']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li>
        <li><?php echo $this->Html->link(__('Listado', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Colectivo', true), array('action' => 'colectivos'));?></li>

        <li>
        <?php
        echo $form->create('', array('action'=>'search'));
        echo $form->input('Buscar', array('type'=>'text'));
        echo $form->end('Buscar');             
        ?>
        </li>
</ul>
</div>