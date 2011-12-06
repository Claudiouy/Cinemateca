<div class="socios form">
<div class="demo ui-widget ui-helper-clearfix">

<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
   
<?php
      $i = 0;
      foreach ($onlyColectivos as $socio):
		
	?>
	<li class=ui-widget-content ui-corner-tr ui-draggable>
	<h5 class="ui-widget-header">C.I:<?php echo $socio['Socio']['documento_identidad']; ?></h5>
                <?php 
                $url = $socio['Socio']['image_url'];?>
<?php echo $this->Html->image('/app/webroot/'.$url, array('class'=>'sociosSeleccionados','id'=>$socio['Socio']['id'],'title'=>$socio['Socio']['surname'].", ".$socio['Socio']['name'], 'width'=>96, 'height'=>72));?>

	 </li>
          
             <?php endforeach; ?>
</ul>
    <div id="agrupado" class="ui-widget-content ui-state-default">
	<h4 class="ui-widget-header"><span class="ui-icon ui-icon-agrupado">agrupado</span> Agrupe aqui a los socios</h4>
</div>
</div>

    <div class="actions">
<ul>

    <?php
    $options = array(
    'label' => 'Asociar Colectivos',
    'name' => 'asociarSociosColectivos',
    'type'=>'button',
    'id'=>'asociarSociosColectivos'
    
    );
    echo $this->Form->end($options);
?>


</ul>
    </div>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Listar Socios', true), array('action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Nuevo Socio', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Menu Principal', true), array('controller'=>'pages','action' => 'home'));?></li>

                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>