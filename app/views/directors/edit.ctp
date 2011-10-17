<?php echo $form->create('Director');?>
<fieldset>
<legend>Edita Director</legend>
<?php
echo $form->hidden('Director.id');
echo $form->input('Director.nombre');
echo $form->input('Director.apellido');
echo $form->input('Director.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$listado, 'empty'=>FALSE));
?>
</fieldset>
<?php echo $form->end('Actualizar');?>

<?php echo $html->link('Listar Todos los Directores', array('action'=>'
index')); ?>
<br /><br />
<?php echo $html->link('Agregar Director', array('action'=>'add')); ?>













