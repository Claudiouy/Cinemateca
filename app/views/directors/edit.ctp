<div class="directors form">
<?php echo $this->Form->create('Director');?>
	<fieldset>
 		<legend id="legend"><?php __('Editar Director'); ?></legend>
<?php
echo $form->hidden('Director.id');
echo $form->input('Director.name', array('label'=>'Nombre:'));
echo $form->input('Director.surname', array('label'=>'Apellido:'));
echo $form->input('Director.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$listado, 'default' => 229));
?>
	</fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>


<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Director.id')), null, sprintf(__('Esta seguro de borrar al director  %s?', true), $this->Form->value('Director.surname'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Directores', true), array('action' => 'index'));?></li>
	</ul>
</div>




