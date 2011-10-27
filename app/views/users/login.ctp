<h3>Login</h3>
    
<?php echo $session->flash('auth');?>
<?php echo $form->create('User', array ('action'=>'login'));?>
<?php echo $form->input('username', array ('label'=>'Nombre de Usuario','action'=>'login'));?>
<?php echo $form->input('password', array ('label'=>'Clave','type'=>'password','action'=>'login'));?>
<?php echo $form->end('Login', array ('action'=>'login'));?>

