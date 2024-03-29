<div class="socios index">
<h2 id="h2"><?php __('Socios');?></h2>

<p><?php
echo $paginator->counter(array(
'format' => __('Pag. %page% de %pages%, mostrando %current% registros de %count% en total, comenzando en registro %start%, finalizando en registro %end%', true)
));
?></p>        
<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Apellido, Nombre');?></th>
                        <th><?php echo $this->Paginator->sort('Doc. Identidad');?></th>
                        <th><?php echo $this->Paginator->sort('Forma de Pago');?></th>
                        <th><?php echo $this->Paginator->sort('Suscripcion');?></th>

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;

        foreach ($onlyActive as $socio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td>
                <?php echo $socio['Socio']['id']; ?>&nbsp;</td>
		<td>
                <?php echo $socio['Socio']['surname'].', ';?>
                <?php echo $socio['Socio']['name'];?></td>
                <td>
                <?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>
        <td>
                <?php echo $socio['PaymentMethod']['name']; ?>&nbsp;</td><td>
                <?php echo $socio['Suscription']['name']; ?>&nbsp;</td>
        
		<td class="actions">
		        <?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $socio['Socio']['id'])); ?>	
                        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $socio['Socio']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $socio['Socio']['id']), null, sprintf(__('Esta Seguro de eliminar el Socio N° %s?', true), $socio['Socio']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	

<div><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	
</div>

<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Nuevo', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('Pagos', true), array('controller'=>'payments','action' =>'index'));?></li>
                <?php if($cantidad > 1){?><li><?php echo $this->Html->link(__('Colectivos', true), array('action' => 'colectivos'));?></li> <?php }?>

                <li><?php echo $this->Html->link(__('Menu', true), array('controller'=>'pages','action' => 'home'));?></li>
                <li><input type="button" value="Graficar" id="loadChartSocioId" class="buttonCakeLike" style="width:100%" /> </li>

                <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
	</ul>
</div>

<div id="containerSocioChart" style="width:50%;left:10%;" >
    <h2 class="tituloGraficas" >Graficas de pagos</h2>
    
    <div class="divCloseButtonContainer" >
        <?php echo $this->Html->image('closeButton2.jpg'); ?>
    </div>
    
    <div>
    
    <input type="button" class="buttonCakeLike" style="width:auto;margin-bottom:15px;" value="Grafica de socios al día" id="buttonPieSocio"/>
    <input type="button" class="buttonCakeLike" style="width:auto;float:right;margin-bottom:15px;" value="Grafica de socios segun edad" id="buttonPieSocioByAge"/>
    
    <div id="containerPieTicket">
    
    </div>
</div>
    
</div>