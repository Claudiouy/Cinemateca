<div class="socios form">
<?php echo $this->Form->create('Socio',array('type'=>'file'));?>
	<fieldset>
 		<legend id="legend"><?php __('Editar Socio'); ?></legend>
      <?php echo $session->flash('auth');?>
	
        
<?php echo $form->hidden('Socio.id');?>

<label for="FileImage">Foto</label>  
<input type="file" name="data[File][image]" id="FileImage" />  
<?php

echo $form->input('Socio.name', array('label'=>'Nombre:'));
echo $form->input('Socio.surname', array('label'=>'Apellido:'));
echo $form->input('fec_nac',array('maxYear' => date('Y', strtotime('-  1 days')),
                                  'minYear' => date('Y', strtotime('- 100 years')
                          )));
?>
<div class="gender">
<?php
$options=array('M'=>'Hombre','F'=>'Mujer');
$attributes=array('legend'=>'Sexo','class'=>'gender');
echo $this->Form->radio('gender',$options,$attributes);
?>
</div>
<?php
echo $form->input('documento_identidad', array('label'=>'Documento de Identidad:'));
echo $form->input('Socio.state_id', array('type' => 'select', 'label'=>'Nacionalidad:', 'options'=>$list_state, 'empty'=>FALSE));
echo $form->input('calle_princ',array('div'=>array('class'=>'false'),'class'=>'callejero','type'=>'text','id'=>'calle_princ','label'=>'Domicilio Particular: '));
echo $form->input('Socio.ocupacion', array('label'=>'Ocupacion:'));
echo $form->input('Socio.tel_fijo', array('label'=>'Tel.:'));
echo $form->input('Socio.celular', array('label'=>'Cel.:'));
echo $form->input('Socio.email', array('label'=>'Email.:'));
echo $form->input('Socio.suscription_id', array( 'label'=>'Tipo de Suscripcion:','type'=> 'select','options'=>$list_suscription, 'empty'=>FALSE));
echo $form->input('Socio.payment_method_id', array('type' => 'select', 'label'=>'Forma de Pago:', 'options'=>$list_pay_method, 'empty'=>FALSE));

?>

<div id="list-creditcards" style="display: none;">
    

<?php 
echo $form->input('Socio.creditcard_id', array('type' => 'select', 'class'=>'select','label'=>'Emisor:', 'options'=>$list_cc));
echo $form->input('Socio.creditcard_number', array('label'=>'Número:', 'title'=>'Ingrese N° de tarjeta de Credito'));
?>
</div>
<?php

echo $form->input('calle_cobro',array('div'=>array('class'=>'false'),'class'=>'callejero','type'=>'text','id'=>'calle_cobro','label'=>'Direccion de cobro:'));
echo $this->Form->hidden('Socio.estado', array('label'=>'Socio activo:','type'=> 'checkbox','empty'=>FALSE));
?>
<div class="colectivo">
<?php

if(!empty ($colec)){?>
    </p>    
<h1>Colectivo :</h1>
<table cellpadding="0" cellspacing="0">
	 

    <tr>
			<th>Socio Id</th>
			<th>Apellido, Nombre</th>
                        <th>Doc. Identidad</th>
	</tr>
	<?php
	$i = 0;

        foreach ($colec as $socio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $socio['Socio']['id']; ?>&nbsp;</td>
		<td><?php echo $socio['Socio']['surname'].', ';?>
                <?php echo $socio['Socio']['name'];?></td>
                <td><?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php } else {

$options=array(0=>'Individual',1=>'Colectivo');
$attributes=array('legend'=>"¿ Es un asociado en Colectivo ?", 'class'=>'colectivo', 'default'=>'Individual','id'=>'colectivo');
echo $this->Form->radio('colectivo',$options,$attributes);
}?>

	</fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Socio.id')), null, sprintf(__('Esta seguro de borrar al Socio N° %s?', true), $this->Form->value('Socio.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado', true), array('action' => 'index'));?></li>
                <?php if (count($colec)>2){?><li><?php echo $this->Html->link(__('Bajar Colectivo', true), array('action' => 'bajarColectivo', $this->Form->value('Socio.id')), null, sprintf(__('Esta seguro Bajar del Colectivo al Socio N° %s?', true), $this->Form->value('Socio.id'))); ?></li><?php }?>
                <li><?php echo $this->Html->link(__('Pagos', true), array('controller'=>'payments','action' =>'retrieveSocioById/'.$this->Form->value('Socio.id')));?></li>
                <?php if($cantidad > 1){?><li><?php echo $this->Html->link(__('Colectivos', true), array('action' => 'colectivos'));?></li> <?php }?>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li>

        </ul>

</div>



