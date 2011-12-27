<div id="paymentsOfSocio">
       
        
            <div id="listOfPaymentsOfSocio" style="margin-left:25%;width: 300px;">
                   <?php   if( !empty($paymentsByFilters) ){
                                
                              echo '<h3 style="margin-left:20px;"> Pagos coincidentes</h3>';
                              echo '<table>';
                                  echo '<tr>';
                                      echo '<td> Detalle </td>';
                                      echo '<td> Monto</td>';
                                      echo '<td> Fecha</td>';                              
                                  echo '</tr>';
                              $i=0;
                               foreach ($paymentsByFilters as $paym) { 
                                   if( $i > 10 ) break;
                                   ?>
                                   <tr>
                                          <td>
                                            <?php  echo $this->Html->link(__('Ver', true), array('action' => 'detail', $paym['Payment']['id'])); ?>
                                          </td>
                                          <td>   
                                             <?php  echo ' $' .$paym['Payment']["amount"];  ?>

                                        </td>
                                        <td>   
                                             <?php  echo 'Fecha'; $i++;  ?>

                                        </td>
                                   </tr>
                                    
                       <?php   } 
                        
                             echo '</table>';   
                           }
                           else{
                                echo '<h2> No hay pagos para esos datos </h2>';
                           }
                   ?>
            </div>
       
    </div>
