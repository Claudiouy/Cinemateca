<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
	<fieldset>
 		<legend><?php __('Editar Usuario'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Usuario.id')), null, sprintf(__('Esta seguro de borrar al Usuario N° %s?', true), $this->Form->value('Usuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('action' => 'index'));?></li>
	</ul>





