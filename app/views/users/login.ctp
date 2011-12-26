<div class="users form">
<?php echo $form->create('User', array ('action'=>'login'));?>
<h3>Ingresar al sistema</h3>
<?php echo $this->Form->create('User');?>
    
    <fieldset>
     <legend id="legend"><?php __('Gestion de Socios'); ?></legend>
    
    
<?php echo $session->flash('auth');?>
 
<?php echo $session->flash('auth');?>

<?php echo $form->input('username', array ('label'=>'Nombre de Usuario','action'=>'login'));?>
<?php echo $form->input('password', array ('label'=>'Clave','type'=>'password','action'=>'login'));?>
<?php echo $form->end('Ingresar', array ('action'=>'login'));?>
</div>
