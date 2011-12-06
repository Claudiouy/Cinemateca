<?php
   //echo $javascript->link('prototype');
   echo $javascript->link('swfobject');
?>

<div class="index">
	<h2><?php __('Pagos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Detalle');?></th>
                        <th><?php echo $this->Paginator->sort('');?></th>
                        <th><?php echo $this->Paginator->sort('Monto');?></th>
                        <th><?php echo $this->Paginator->sort('Fecha');?></th>
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
                    <td><?php echo 'fecha'; ?></td>
                    <td class="actions">
                        <?php if(empty($pay['Payment']['id_canceled']) && $pay['Payment']['canceled'] == 0 ){ 
                            echo $this->Html->link(__('Anular', true), array('action' => 'cancel_payment', $pay['Payment']['id'])); 
                        
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
                <li><?php echo $this->Html->link(__('Consultar pagos', true), array('action' => 'payment_filters')); ?></li>
                <li>
                    <?php  /*
                       echo $flashChart->begin();
                        $flashChart->setData(array(1,2,4,8));
                        echo $flashChart->chart();
                        //var_dump($flashChart);
                       echo $flashChart->render(400, 250);  */  
                    ?>

                </li>
        </ul>
</div>
