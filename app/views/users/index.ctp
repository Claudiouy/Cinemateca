<div class="usuarios index">
    <h2 id="h2"><?php __('Usuarios');?></h2>
    <?php echo $session->flash('auth');?>

<p><?php
echo $paginator->counter(array(
'format' => __('Pag. %page% de %pages%, mostrando %current% registros de %count% en total, comenzando en registro %start%, finalizando en registro %end%', true)
));
?></p> 
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Nombre');?></th>
			<th><?php echo $this->Paginator->sort('Rol');?></th>

                        <th class="actions"><?php __('Acciones');?></th>
	</tr>
 

	<?php

        
        $i = 0;
	foreach ($onlyActive as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = 'class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['roles']; ?>&nbsp;</td>
	
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $user['User']['id'])); ?>

			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Esta Seguro de eliminar el usuario %s?', true), $user['User']['username'])); ?>
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
                <li><?php echo $this->Html->link(__('Menu', true), array('controller' => 'pages', 'action' => 'display', 'home'));?></li>
                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>