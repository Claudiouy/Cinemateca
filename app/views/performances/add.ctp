<div class="performances form">
<?php echo $this->Form->create('Performance');?>
<fieldset>
 	<legend id="legend"><?php __('Nueva Función'); ?></legend>
        
<?php echo $session->flash('auth');?>

<?php
$current_year = date('Y');
$max_year = $current_year + 1;
$min_year = $current_year;

echo $form->hidden('id');
echo $form->input('Sala.id', array('type' => 'select', 'class'=>'select','label'=>'Sala:', 'options'=>$list_salas));
echo $form->input('Performance.fecha', array( 'minYear' => $min_year, 'maxYear'=>$max_year));
echo $form->input('Performance.hora_comienzo', array('timeFormat'=>24, 'label'=>'Hora Comienzo:'));
echo $form->input('Pelicula.id', array('type' => 'select', 'class'=>'select','label'=>'Pelicula:', 'options'=>$list_pelis));
echo $form->input('Performance.precio', array('label'=>'Precio Funcion:'));
?>
        <div class="estreno">
<?php

$options=array(1=>'SI',0=>'NO');
$attributes=array('legend'=>"¿Es estreno? ", 'class'=>'estreno');
echo $this->Form->radio('estreno',$options,$attributes);
?>
</div>
            </fieldset>
<?php echo $this->Form->end(__('Agregar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Director.id')), null, sprintf(__('Esta seguro de borrar al director  %s?', true), $this->Form->value('Director.surname'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li></ul>

</div>




