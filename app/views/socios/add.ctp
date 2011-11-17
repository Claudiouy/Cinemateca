<div class="socios form">
<?php echo $this->Form->create('Socio',array('type'=>'file'));?>

 
    
    <fieldset>
     <legend id="legend"><?php __('Registro de  Socio'); ?></legend>
    
    
<?php echo $session->flash('auth');?>
<?php

echo $form->hidden('Socio.id');
?>
<label for="FileImage">Foto:</label>  
<input type="file"  name="data[File][image]" id="FileImage" />  
    
<?php

echo $form->input('Socio.name', array('label'=>'Nombre:' ,'id'=>'autoComplete'));

echo $form->input('Socio.surname', array('label'=>'Apellido:'));
?>
<?php

$options=array('M'=>'Hombre','F'=>'Mujer');
$attributes=array('legend'=>"Sexo:");
echo $this->Form->radio('gender',$options,$attributes);



echo $datePicker->picker('fec_nac' ,array('maxYear'=> date('Y'),'minYear'=>date('Y') - 100)); 


echo $form->input('documento_identidad', array('label'=>'Documento de Identidad:'));

echo $form->input('Socio.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$list_state, 'empty'=>true, 'alt'=>'Seleccione una nacionalidad'));


echo $this->Form->input('calle_princ',array('type'=>'text','id'=>'calle_princ','label'=>'Direccion'));

echo $form->input('Socio.ocupacion', array('label'=>'Ocupacion:'));
echo $form->input('Socio.tel_fijo', array('label'=>'Tel.:'));
echo $form->input('Socio.celular', array('label'=>'Cel.:'));
echo $form->input('Socio.email', array('label'=>'Email.:'));
?>
<?php
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
