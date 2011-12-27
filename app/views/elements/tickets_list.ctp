<table >
    <tr>
        
        <td>
            Id                
        </td>
        
        <td>
            Nombre de sala
        </td>
        
        <td>
            Importe
        </td>
        
        <td>
            Fecha y hora de comienzo
        </td>
        
        <td>
            Nombre de socio
        </td>
        
        <td>
            Acciones
        </td>
    </tr>
    
    <tr>
        <?php $amountSize = 0;
        $numberOfTickets = 0;
              if(!empty($ticketsFromToday)) {
            //var_dump($klist);
                    
                    foreach($ticketsFromToday as $tick){
         ?>         
                        <tr>
                            
                            <td>
                                <?php  echo $tick['Ticket']['id']; ?>
                            </td>
                            
                            <td>
                                <?php echo $tick['Performance']['Sala']['name']  ?>
                            </td>

                            <td>
                                <?php  echo $tick['Ticket']['amount_ticket'];
                                       $amountSize += $tick['Ticket']['amount_ticket'];
                                ?>
                            </td>

                            <td>
                                <?php  echo $tick['Ticket']['created']; ?>
                            </td>

                            <td>
                                <?php  if($tick['Socio']['id'] != 0){
                                            echo $tick['Socio']['name']. ' '.$tick['Socio']['surname'] ; 
                                       }
                                       else{
                                           echo '---';
                                       }
                                ?>
                            </td>
                            
                            <td>
                                <div  >
                                    <?php
                                    
                                        if(empty($tick['Ticket']['id_canceled']) && $tick['Ticket']['canceled'] == 0 ){
                                            $numberOfTickets++ ;
                                            ?>
                                            
                                            <input type="hidden" class="hiddenTicketClass"  value="<?php echo $tick['Ticket']['id']?>" />
                                            <input type="button" style="width:auto;" value="Reimprimir" id="reprintTicketButton" class="buttonCakeLike" />
                                        <?php
                                            echo $this->Html->link(__('Anular', true), array('action' => 'cancelTicket', $tick['Ticket']['id']), null, sprintf(__('Esta Seguro de eliminar la entrada N° %s?', true), $tick['Ticket']['id'])); 
                                        }
                                        else{
                                            if(!empty($tick['Ticket']['id_canceled'])){
                                                echo 'Anula entrada nº: '.$tick['Ticket']['id_canceled'] ;
                                            }
                                            else{
                                                echo 'Anulado.';
                                            }
                                        }
                                            ?>
                                    </div>
                            </td>
                        </tr>
        <?php
                    }
              }
              else{
                  echo 'No hay entradas para estas fechas';
              }
        ?>
    </tr>
    
    <tr>
        <td>
            Total            
        </td>
        
        <td>
            
        </td>
        
        <td>
            Total importe = <?php echo $amountSize; ?>
        </td>
        
        <td>
            
        </td>
        
        <td>
            Total entradas = <?php echo $numberOfTickets;
                            ?> 
        </td>
        
    </tr>
    
    
</table>