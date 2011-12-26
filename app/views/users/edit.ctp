<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend id="legend"><?php __('Editar Usuario'); ?></legend>
        <?php echo $session->flash('auth');?>

	<?php
        echo $this->Form->input('User.username');
        echo $this->Form->input('User.password');
        echo $this->Form->input('password_confirmation',array('type'=>'password'));
        
        if($admin){
         echo $this->Form->input('roles', array(
            'options' => array('admin' => 'admin', 'usuario' => 'usuario')
        ));
        }
        
	?>
	</fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Esta seguro de borrar al Usuario N° %s?', true), $this->Form->value('Usuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('action' => 'index'));?></li>
	</ul>





