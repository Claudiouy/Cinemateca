<div class="directors form">
<?php echo $this->Form->create('Director');?>
<fieldset>
 	<legend id="legend"><?php __('Nuevo Director'); ?></legend>
        
<?php echo $session->flash('auth');?>

<?php
echo $form->hidden('id');
echo $form->input('name', array('label'=>'Nombre:'));
echo $form->input('surname', array('label'=>'Apellido:'));
echo $form->input('Director.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$listado, 'empty'=>TRUE));
?>
            </fieldset>
<?php echo $this->Form->end(__('Agregar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Director.id')), null, sprintf(__('Esta seguro de borrar al director  %s?', true), $this->Form->value('Director.surname'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li>

	</ul>
</div>




