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
    </tr>
    
    <tr>
        <?php $amountSize = 0;
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
            Total entradas = <?php if(!empty($ticketsFromToday)) {
                                            echo count($ticketsFromToday);
                                        }
                                        else{
                                            echo 0;
                                        }
                            ?> 
        </td>
        
    </tr>
    
    
</table>