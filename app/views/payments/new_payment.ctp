<div>
    

    <div style="width:50%; margin-bottom:15px;" ><input type="button" id="openSearchSocio" value="Buscar cliente" /> </div>
    <div id="selectedSocio">
               <?php if(!empty($selSocio)) {
                  echo $form->create('Payment', array('action' => 'set_payment')); 
                  echo 'El pago se efectuará para el cliente: '.$selSocio["Socio"]["name"]. ' ' . $selSocio["Socio"]["surname"] ; 
               echo $this->Form->input('idSocio', array('type' => 'hidden', 'value' => $selSocio["Socio"]["id"])); ?>
               
           <div style="width:50%;" >    <div id="amountContainer">
                   Ingrese cantidad de cuotas: <?php echo $this->Form->input('numberQuotas', array('type' => 'text')); ?>
               </div> 
           </div>
           <?php echo $this->Form->end('Aplicar pago'); }?>
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
    
    <div id="searchSocioContainer" style="color:white;">
        <div id="closeButton" ></div>
        Busqueda por socio
        <input type="text" id="socioNameSearch" />
        <input type="button" value="Consultar" id="retrieveSocios" />        
        <div id="socioData">
                
        </div>
    </div>
    
    
</div>
