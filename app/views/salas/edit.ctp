<div class="salas form">
<?php echo $this->Form->create('Sala');?>
<fieldset>
 	<legend id="legend"><?php __('Editar Sala'); ?></legend>
        
<?php echo $session->flash('auth');?>

<?php


echo $form->hidden('Sala.id');
echo $form->input('Sala.id');
echo $form->input('Sala.name');
echo $form->input('Sala.capacidad');


?>
       
            </fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Director.id')), null, sprintf(__('Esta seguro de borrar la sala  %s?', true), $this->Form->value('Sala.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li></ul>

</div>




