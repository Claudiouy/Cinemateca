<table id="ticketSocioContainer">
    <tr>
        <td>
            <div id="searchSocioTicketContainer">
                Ingrese el documento del cliente: <input type="text" id="socioDocument" />
                <input type="button" value="Buscar" id="findSocioByDoc" />
               
            </div>
            <div>
                <?php echo $form->create('Ticket', array('action' => 'create_new_socio_ticket')); ?>
                Seleccione la función
                <select id="performanceIdForTicket" name="performanceIdForTicket">
                    <option value="-1">--None--</option>
                    <?php
                      if(!empty($allPerformances)){
                          foreach ($allPerformances as $perf) { ?>
                            <option value='<?php echo $perf["Performance"]["id"]?>'><?php echo $perf["Pelicula"]["name"]. ' - '. $perf["Performance"]["hora_comienzo"]   ?></option> 
                    
                          <?php } 
                      }
                    ?>
                </select>
            </div>
        </td>
        
        <td>
               <div id="dataSocioTicketContainer" >
                   
                    <div id="socioByDocResult">
                        Socio: <input type="text" readonly="readonly" id="inputReadOnlySocio" />
                            
                            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                    </div>
                </div>
            
        </td>    
    </tr>  
</table>
<div style="float:left;"> <?php echo $this->Form->end('Generar entrada'); ?> 
</div>
<div style="float:right;">
                    <?php //echo  $this->Html->link(__('Ingreso a no socio', true), array('action' => 'create_new_no_socio_ticket', ), null, sprintf(__('¿Esta seguro de generar el pago?', true))); ?>
                    <input type="button" value="Ingreso a no socio" onclick="window.location ='/cake_primero/tickets/create_new_no_socio_ticket/' + $('#performanceIdForTicket').val()" />    
    </div><br /><br /><br /><br /> <br/> 
<?php  echo $this->Form->input('from', array('label' => 'Desde' , 'type' => 'date', 'id' => 'dateFrom')); ?>
            
          <?php  echo $this->Form->input('to', array('label' => 'Hasta' , 'type' => 'date', 'id' => 'dateTo', 'style' => 'margin-left:32px;')); ?>
<input type="button" value="Refrescar" id="refreshTicketsButton" />
<div id="tableTicketsContainer">
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
</div>
    