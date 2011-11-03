<div class="actors form">
<?php echo $this->Form->create('Socio',array('type'=>'file'));?>
<fieldset>
     <legend><?php __('Registro de  Socio'); ?></legend>
    
    
    <?php echo $session->flash('auth');?>
<?php

echo $form->hidden('Socio.id');
?>


<?php

echo $form->input('Socio.name', array('label'=>'Nombre:'));
echo $form->input('Socio.surname', array('label'=>'Apellido:'));
echo $form->input('documento_identidad', array('label'=>'Documento de Identidad:'));
echo $form->input('Socio.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$list_state, 'empty'=>FALSE));
?>

<div id="results"></div>
     
<?php

echo $form->input('Socio.ocupacion', array('label'=>'Ocupacion:'));
echo $form->input('Socio.tel_fijo', array('label'=>'Tel.:'));
echo $form->input('Socio.celular', array('label'=>'Cel.:'));
echo $form->input('Socio.email', array('label'=>'Email.:'));
echo $form->input('Socio.suscription_id', array( 'label'=>'Tipo de Suscripcion:','type'=> 'select','options'=>$list_suscription, 'empty'=>FALSE));
echo $form->input('Socio.payment_method_id', array('type' => 'select', 'label'=>'Forma de Pago:', 'options'=>$list_pay_method, 'empty'=>FALSE));

?>

</fieldset>
<?php echo $this->Form->end(__('Agregar',true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
 <?php if($admin): ?>
		<li><?php echo $this->Html->link(__('Listar Socios', true), array('action' => 'index'));?></li>
 <?php endif; ?>
        </ul>
</div>