<?php echo $form->create('Director');?>
<fieldset>
<legend>Añadir Nuevo Director</legend>

<?php

echo $form->input('nombre');
echo $form->input('apellido');
echo $form->input('Director.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$listado, 'empty'=>TRUE));
?>

</fieldset>
<?php echo $form->end('Añadir Director');?>
<br />
<?php echo $html->link('Listar todos los Directores', array('action'=>'index')); 
?>
		

