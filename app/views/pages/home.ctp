<h3>
    Login
</h3>
<?php echo $session->flash('auth');?>
<?php echo $form->create('User', array ('action'=>'login'));?>
<?php echo $form->input('username', array('label'=>'Nombre de Usuario'));?>
<?php echo $form->input('password', array('label'=>'Ingrese la Clave', 'type'=>'password'));?>
<?php echo $form->end('Login');

