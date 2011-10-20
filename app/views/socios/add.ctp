<?php echo $form->create('Socio');?>
<fieldset>
<legend>Añadir Nuevo Socio</legend>

<?php

echo $form->hidden('Socio.id');

echo $form->input('Socio.foto', array('label'=>'Foto:','type'=>'file'));
echo $form->input('Socio.name', array('label'=>'Nombre:'));
echo $form->input('Socio.surname', array('label'=>'Apellido:'));
echo $form->input('documento_identidad', array('label'=>'Documento de Identidad:'));
echo $form->input('Socio.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$list_state, 'empty'=>FALSE));
//echo $form->input('Socio.street_id', array('type' => 'select', 'label'=>'Calle:', 'options'=>$list_street, 'empty'=>FALSE));         
echo $form->input('Socio.ocupacion', array('label'=>'Ocupacion:'));
echo $form->input('Socio.tel_fijo', array('label'=>'Tel.:'));
echo $form->input('Socio.celular', array('label'=>'Cel.:'));
echo $form->input('Socio.email', array('label'=>'Email.:'));
echo $form->input('Socio.subscription_id', array( 'label'=>'Tipo de Suscripcion:','type'=> 'select','options'=>$list_suscription, 'empty'=>FALSE));
echo $form->input('Socio.payment_method_id', array('type' => 'select', 'label'=>'Forma de Pago:', 'options'=>$list_pay_method, 'empty'=>FALSE));

?>

</fieldset>
<?php echo $form->end('Añadir Socio');?>
<br />
<?php echo $html->link('Listar todos los Socios Activos', array('action'=>'index')); 
?>
	