<div class="performances form">
<?php echo $this->Form->create('Performance');?>
<fieldset>
 	<legend id="legend"><?php __('Editar Funcion'); ?></legend>
        
<?php echo $session->flash('auth');?>

<?php
echo $form->hidden('Performance.id');
echo $form->input('Sala.id', array('type' => 'select', 'class'=>'select','label'=>'Sala:', 'options'=>$list_salas, 'empty'=>FALSE));
echo $form->input('Performance.fecha', array('label'=>'Fecha:'));
echo $form->input('Performance.horaComienzo', array('label'=>'Hora Comienzo:'));
echo $form->input('Pelicula.id', array('type' => 'select', 'class'=>'select','label'=>'Pelicula:', 'options'=>$list_pelis, 'empty'=>FALSE));
echo $this->Form->hidden('Performance.estado', array('label'=>'Estado Funcion:','type'=> 'checkbox','empty'=>FALSE));

?>
        <div class="estreno">
<?php

$options=array(1=>'SI',0=>'NO');
$attributes=array('legend'=>"¿ Es Estreno ?", 'class'=>'estreno');
echo $this->Form->radio('estreno',$options,$attributes);
?>
</div>
            </fieldset>
<?php echo $this->Form->end(__('Actualizar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Director.id')), null, sprintf(__('Esta seguro de borrar al director  %s?', true), $this->Form->value('Director.surname'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Funciones', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Menu Principal', true), array('controller'=>'pages','action' => 'home'));?></li></ul>

</div>




