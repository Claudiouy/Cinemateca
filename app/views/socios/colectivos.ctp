<div class="socios form">
<?php echo $this->Form->create('Socio');?>

    
<h2 id="h2"><?php __('Asociacion en colectivo de Socios');?></h2>

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

			<th class="actions"><?php __('Agrupar');?></th>
	</tr>

	<?php
        $i = 0;
        foreach ($onlyColectivos as $socio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
                <?php echo $socio['Socio']['id']; ?>&nbsp;</td>
		<td>
                <?php echo $socio['Socio']['surname'].', ';?>
                <?php echo $socio['Socio']['name'];?></td>
                <td>
                <?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>

		<td class="actions">
                    <?php echo $this->Form->checkbox('colectivo' ,array ('class'=>'sociosSeleccionados','id'=>$socio['Socio']['id'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>

    <div class="actions">
<ul>

    <?php
    $options = array(
    'label' => 'Asociar Colectivos',
    'name' => 'asociarSociosColectivos',
    'type'=>'button',
    'id'=>'asociarSociosColectivos'
    
    );
    echo $this->Form->end($options);
?>


</ul>
    </div>
    
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
		<li><?php echo $this->Html->link(__('Listar Socios', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Nuevo Socio', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Menu Principal', true), array('controller'=>'pages','action' => 'home'));?></li>

                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>