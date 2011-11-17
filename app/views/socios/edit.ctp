<div class="socios form">
<?php echo $this->Form->create('Socio',array('type'=>'file'));?>
	<fieldset>
 		<legend id="legend"><?php __('Editar Socio'); ?></legend>
	
        
<?php echo $form->hidden('Socio.id');?>

<label for="FileImage">Foto</label>  
<input type="file" name="data[File][image]" id="FileImage" />  
<?php

echo $form->input('Socio.name', array('label'=>'Nombre:'));
echo $form->input('Socio.surname', array('label'=>'Apellido:'));
echo $datePicker->picker('fec_nac' ,array('maxYear'=> date('Y'),'minYear'=>date('Y') - 100)); 
$options=array('M'=>'Hombre','F'=>'Mujer');
$attributes=array('legend'=>'Sexo');
echo $this->Form->radio('gender',$options,$attributes);

echo $this->Form->input('documento_identidad', array('label'=>'Documento de Identidad:'));
echo $form->input('Socio.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$list_state, 'empty'=>FALSE));
echo $this->Form->input('calle_princ',array('type'=>'text','id'=>'calle_princ','label'=>'Direccion'));
echo $this->Form->input('Socio.ocupacion', array('label'=>'Ocupacion:'));
echo $this->Form->input('Socio.tel_fijo', array('label'=>'Tel.:'));
echo $this->Form->input('Socio.celular', array('label'=>'Cel.:'));
echo $this->Form->input('Socio.email', array('label'=>'Email.:'));
echo $this->Form->input('Socio.suscription_id', array( 'label'=>'Tipo de Suscripcion:','type'=> 'select','options'=>$list_suscription, 'empty'=>FALSE));
echo $form->input('Socio.payment_method_id', array('type' => 'select', 'label'=>'Forma de Pago:', 'options'=>$list_pay_method, 'empty'=>FALSE));
echo $this->Form->hidden('Socio.estado', array('label'=>'Socio activo:','type'=> 'checkbox','empty'=>FALSE));

?>
	</fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Usuario.id')), null, sprintf(__('Esta seguro de borrar al Socio N° %s?', true), $this->Form->value('Socio.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Socios', true), array('action' => 'index'));?></li>
	</ul>

</div>



