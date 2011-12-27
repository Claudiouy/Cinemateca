<div>
    <?php echo $this->Session->flash(); ?>
    <div style="width:50%; margin-bottom:15px;" ><input type="button" class="buttonCakeLike" style="width:auto;" id="openSearchSocio" value="Buscar cliente" /> </div>

    <div id="selectedSocio">
               <?php if(!empty($selSocio)) {
                  //echo $form->create('Payment', array('action' => 'set_payment')); 
                  echo 'El pago se efectuará para el cliente: '.$selSocio["Socio"]["name"]. ' ' . $selSocio["Socio"]["surname"] ; 
                  ?>
              
        <br /><br /><br />
            Sala <br />
            <div style="margin-bottom:10px;">
                <?php if(!empty($selSala)) echo $selSala['Sala']['name']; echo $this->Form->input('idOfSala', array('type' => 'hidden', 'value' => $selSala['Sala']['id'])); ?>  
            </div>
        <?php
                
               echo $this->Form->input('idSocio', array('type' => 'hidden', 'value' => $selSocio["Socio"]["id"])); ?>
               
           <div style="width:50%;margin-top:10px;" >    <div id="amountContainer">
                  <?php echo $this->Form->input('numberQuotas', array('type' => 'text', 'label' => 'Numero de cuotas')); ?>
               </div> 
           </div>
           <br /><br /><br /><br />
            <input type="button" value="Aplicar pago" class="buttonCakeLike" style="width:auto;" id="applyPaymentId" />
           <?php } ?>
    </div>
    
    <div id="paymentsOfSocio">
        
        <?php if(!empty($selSocio) ){ ?>
            <div id="listOfPaymentsOfSocio" style="margin-left:25%;">
                   <?php   if( !empty($paymentsSocio) ){
                              echo '<h3 style="margin-left:20px;"> Ultimos 10 pagos del socio</h3>';
                              echo '<table>';
                              echo '<tr>';
                              echo '<td> Detalle </td>';
                              echo '<td> Monto</td>';
                              echo '<td> Fecha</td>';                              
                              echo '</tr>';
                              $i=0;
                               foreach ($paymentsSocio as $paym) { 
                                   if( $i > 10 ) break;
                                   ?>
                                   <tr>
                                          <td>
                                            <?php  echo $this->Html->link(__('Ver', true), array('action' => 'detail', $paym['id'])); ?>
                                          </td>
                                          <td>   
                                             <?php  echo ' $' .$paym["amount"];  ?>

                                        </td>
                                        <td>   
                                             <?php  echo 'Fecha'; $i++;  ?>

                                        </td>
                                   </tr>
                                    
                       <?php   } 
                        
                             echo '</table>';   
                           }
                           else{
                                echo '<h2> No hay pagos para ese socio </h2>';
                           }
                   ?>
            </div>
        <?php } ?>
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
    
    
</div>
