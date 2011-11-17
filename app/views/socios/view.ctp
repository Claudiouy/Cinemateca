<div class="socios index">
    
	<h2 id="h2"><?php __('Socios');?></h2>
        
<table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo('Id.');?></th>
            <th><?php echo('Apellido, Nombre');?></th>
            <th><?php echo('Doc. Identidad');?></th>
            <th><?php echo('Suscripcion');?></th>
            <th><?php echo('Forma de Pago');?></th>
            <th><?php echo('Socio Desde');?></th>
            <th><?php echo('Fecha de Nac.');?></th>
            <th><?php echo('Foto');?></th>
            
            <th class="actions"><?php __('Acciones');?></th>
	</tr>
	
	<tr>
            
<td><?php echo $socio['Socio']['id']; ?>&nbsp;</td>
<td><?php echo $socio['Socio']['surname'].', ';?><?php echo $socio['Socio']['name'];?></td>
<td><?php echo $socio['Socio']['documento_identidad']; ?>&nbsp;</td>
<td><?php echo $socio['Suscription']['name']; ?>&nbsp;</td>
<td><?php echo $socio['PaymentMethod']['name']; ?>&nbsp;</td>  
<td><?php echo $socio['Socio']['created']; ?>&nbsp;</td>  
<td><?php echo $socio['Socio']['fec_nac']; ?>&nbsp;</td>	
<td><?php
    if(!empty($socio['Socio']['image_url'])) {  
    $url = $socio['Socio']['image_url'];  
    echo '<div class="uploaded_image">';  
    ?>
<?php
    echo $this->Html->image('/'.'app/webroot/'.$url, array('width'=>100 ,'height'=>100, 'border'=>1));
    ?>
</td>
    <?php
    
    
    echo '</div>';  
}  
?>

<td class="actions">
        <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $socio['Socio']['id'])); ?>
	<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $socio['Socio']['id']), null, sprintf(__('Esta Seguro de eliminar al socio N° %s?', true), $socio['Socio']['id'])); ?>
             
          
        </td>
	</tr>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Nuevo Socio', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Socios', true), array('action' => 'index'));?></li>
	        <li><?php echo $this->Html->link(__('Imprimir', true), array('action' => 'pdf'));?></li>

        <li>
                <?php
                echo $form->create('', array('action'=>'search'));
                echo $form->input('Buscar', array('type'=>'text'));
                echo $form->end('Buscar');             
                ?>
                </li>
        </ul>
</div>