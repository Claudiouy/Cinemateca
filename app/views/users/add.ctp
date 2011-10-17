<?php echo $form->create('User');?>
<fieldset>
<legend>Añadir Nuevo Usuario</legend>
<?php


echo $form->input('nombre');
echo $form->input('password');
?>

</fieldset>
<?php echo $form->end('Añadir Usuario');?>
<br />
<?php echo $html->link('Listar todos los Usuarios', array('action'=>'index')); ?>