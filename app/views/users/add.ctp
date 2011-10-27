<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php __('Registro de  Usuario'); ?></legend>
    
    
    <?php echo $session->flash('auth');?>
   
    <?php
        echo $this->Form->input('username',array('label'=>'Nombre de usuario:'));
        echo $this->Form->input('password',array('label'=>'Escriba una clave:'));
        echo $this->Form->input('password_confirmation',array('type'=>'password','label'=>'Confirme la clave:'));
        
        if($admin)
            {
                echo $this->Form->input('roles', array('label'=>'Seleccione el Rol:',
            'options' => array('usuario' => 'usuario','admin' => 'admin' )
        ));
        }
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Agregar',true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
 <?php if($admin): ?>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('action' => 'index'));?></li>
 <?php endif; ?>
        </ul>
</div>




