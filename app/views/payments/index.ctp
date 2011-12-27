
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
                            ?>
                            <div style="float:right;display:none;" id="loadingContainer<?php echo$pay['Payment']['id'] ?>">
                                <?php echo $this->Html->image('loading.gif'); ?>
                            </div>
                            <div style="float:right;margin-right:70px;">
                                <input type="hidden" class="hiddenPaymentClass"  value="<?php echo $pay['Payment']['id']?>" />
                                <input type="button" value="Reimprimir" id="reprintPaymentButton" class="buttonCakeLike" />
                                
                            </div>
                            
                            
                        <?php
                        } else {
                            if(!empty($pay['Payment']['id_canceled'])){
                                echo 'Anula pago nº: '.$pay['Payment']['id_canceled'] ;
                            }
                            else{
                                echo 'Anulado.';
                            }
                           ?>
                             <div style="float:right;margin-right:70px;width:120px;height:10px;">
                            </div>
                        
                        <?php
                        }
                        ?>                              
                       
                        
                    </td>
            </tr>
                <?php endforeach;
                
                }
                else{
                    echo '<h2>No hay pagos con esos datos</h2>';
                }
?>
	</table>
	

	
</div>


<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><input type="button" id="openSearchSocio" class="buttonCakeLike" value="Ingresar pago"  </li>
                <li><input type="button"id="searchPaymentId" value="Buscar" class="buttonCakeLike" /></li>
                <li><input type="button"id="chartPaymentButton" value="Graficas" class="buttonCakeLike" /></li>
                <div class="filterPaymentContainer">
        
                    <h2 class="tituloGraficas" >Búsqueda</h2>
                    <div class="divCloseButtonContainer" >
                        <?php echo $this->Html->image('closeButton2.jpg'); ?>
                    </div>
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

<div style="margin-left:45%;"><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	

<div id="containerPaymentsChart">
    <h2 class="tituloGraficas" >Graficas de pagos</h2>
    
    <div class="divCloseButtonContainer" >
        <?php echo $this->Html->image('closeButton2.jpg'); ?>
    </div>
    
    <div style="float:left;width:28%;margin: 0px 0 20px 23px;">
            <div style="width:100%;" >
                <input type="button" value="Graficar" class="buttonCakeLike" id="buttGraficas" />
                <input type="button" value="Graficar por importe del pago" id="buttChartAmount" class="buttonCakeLike" />
            </div>
          <?php  echo $this->Form->input('from', array('label' => 'Desde' , 'type' => 'date', 'id' => 'dateFrom')); ?>
            <br /><br /><br /><br />
          <?php  echo $this->Form->input('to', array('label' => 'Hasta' , 'type' => 'date', 'id' => 'dateTo')); ?>
    </div>
    
    
    
<div id="container2" style="float:left;width: auto;height: auto;margin-left: 3%;margin-bottom: 8px; "></div>

</div>

<div id="searchSocioContainer" style="color:white;width: 40%;">

        
        <h2 class="tituloGraficas" >Busqueda por socio</h2>
        <div class="divCloseButtonContainer" >
            <?php echo $this->Html->image('closeButton2.jpg'); ?>
        </div>
    
        <input type="text" id="socioNameSearch" style="width:70%;margin-left:10px;" /> <br />
        <input type="button" value="Consultar" class="buttonCakeLike" style="width:auto;margin: 10px;" id="retrieveSocios" />        
        <div id="socioData" style="margin-bottom:10px;">
                
        </div>
    </div>



