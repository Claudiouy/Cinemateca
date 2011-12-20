
<div class="index">
	<h2 id="h2"><?php __('Pagos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Detalle');?></th>
                        <th><?php echo $this->Paginator->sort('');?></th>
                        <th><?php echo $this->Paginator->sort('Monto');?></th>
                        <th><?php echo $this->Paginator->sort('Fecha y hora de pago');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
        if(!empty($allPayments)){
            foreach ($allPayments as $pay):
                    $class = null;
                    if ($i++ % 2 == 0) { 
                            $class = ' class="altrow"';
                    }
            ?>
            <tr<?php echo $class;?>>

                    <td><?php echo $pay['Payment']['id']; ?>&nbsp;</td>
                    <td><?php echo $this->Html->link(__('Ver detalle', true), array('action' => 'detail', $pay['Payment']['id'])); ?></td>
                    </td>
                    <td><?php  ?>&nbsp;</td>
                    <td><?php echo '$'.$pay['Payment']['amount'];?></td>
                    <td><?php echo $pay['Payment']['created']; ?></td>
                    <td class="actions">

                        <?php if(empty($pay['Payment']['id_canceled']) && $pay['Payment']['canceled'] == 0 ){ 
                            echo $this->Html->link(__('Anular', true), array('action' => 'cancel_payment', $pay['Payment']['id']), null, sprintf(__('Esta Seguro de eliminar el Pago N° %s?', true), $pay['Payment']['id'])); 
                        
                        } else {
                            if(!empty($pay['Payment']['id_canceled'])){
                                echo 'Anula pago nº: '.$pay['Payment']['id_canceled'] ;
                            }
                            else{
                                echo 'Anulado.';
                            }
                        }
?>

                    </td>
            </tr>
                <?php endforeach;}?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ingresar pago', true), array('action' => 'new_payment')); ?></li>
                <li><?php echo $this->Html->link(__('Graficas', true), array('action' => 'charts')); ?></li>
                <li><input type="button"id="searchPaymentId" value="Buscar" /></li>
                <div class="filterPaymentContainer">
        
                    <?php
                        echo $form->create('Payment', array('action' => 'payment_filters_method', 'style ' => 'margin:2px;'));
                        echo $this->Form->input('nameSocioOfPayment', array('label' => 'Nombre'));
                        echo $this->Form->input('lastNameSocioOfPayment', array('label' => 'Apellido'));
                        echo $this->Form->input('ciSocioOfPayment', array('label' => 'Documento'));
                        echo $this->Form->input('amountOfPayment', array('label' => 'Monto'));
                        echo $this->Form->end('Consultar');
                    
                    
                    ?>
                            
                </div>

                <div style="width:100%;float:left;height:100%;" id="paymentsContainer">

                </div>  
                
        </ul>

</div>
