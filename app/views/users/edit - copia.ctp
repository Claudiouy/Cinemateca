<?php echo $form->create('Usuario');?>
<fieldset>
<legend>Edita Usuario</legend>
<?php
echo $form->hidden('id');
echo $form->input('nombre');
echo $form->input('password');
?>
</fieldset>
<?php echo $form->end('Actualizar');?>

<?php echo $html->link('Listar Todos los Usuarios', array('action'=>'
index')); ?>
<br /><br />
<?php echo $html->link('Agregar Usuario', array('action'=>'add')); ?>













