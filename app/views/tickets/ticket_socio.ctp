<div id="ticketSaleContainer"> 
    <h2 class="tituloGraficas" >Venta de entradas</h2>
    
    <div class="divCloseButtonContainer" >
        <?php echo $this->Html->image('closeButton2.jpg'); ?>
    </div>
    <table id="ticketSocioContainer" class="backSkyblue" >
        <tr>
            <td>
                <div id="searchSocioTicketContainer">
                    Ingrese el documento del cliente: <input type="text" id="socioDocument" />
                    <input class="buttonCakeLike" style="width:auto;" type="button" value="Buscar" id="findSocioByDoc" />

                </div>
                <div>
                    <?php echo $form->create('Ticket', array('action' => 'create_new_socio_ticket')); ?>
                    Seleccione la función <br/>
                    <select id="performanceIdForTicket" name="performanceIdForTicket" >
                        <option value="-1">--None--</option>
                        <?php
                          if(!empty($allPerformances)){
                              
                              foreach ($allPerformances as $perf) { ?>
                                <option value='<?php echo $perf["Performance"]["id"]?>'><?php echo 'Sala: '. $perf["Sala"]["name"]. ', ' . $perf["Pelicula"]["name"]. ' - '. $perf["Performance"]["hora_comienzo"];  ?></option> 

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
    <div style="float:left;"> <input type="button" class="buttonCakeLike" style="width:auto" value="Generar entrada" id="buttonGenerateTicket" /> 
    </div>
    <div style="float:right;">
                        <?php //echo  $this->Html->link(__('Ingreso a no socio', true), array('action' => 'create_new_no_socio_ticket', ), null, sprintf(__('¿Esta seguro de generar el pago?', true))); ?>
                        <input class="buttonCakeLike" style="width:auto;margin:18px 10px 0 0;" type="button" value="Ingreso a no socio"  id="butNoSocioTicket" />    
        </div>


</div>

<h2 style="text-align: center;color:#489;">
    Entradas
</h2>

<hr style="margin-bottom:30px;" />

<div class="paymentListButtonContainer" >
    <input type="button" id="ticketSaleId" class="buttonCakeLike" style="width:auto;float:left;margin-bottom:20px;" value="Ingreso a sala" /> <br /><br /><br />
    
    <hr style="margin-bottom:30px;"  />
    <div >
        <?php  echo $this->Form->input('from', array('label' => 'Desde' , 'type' => 'date', 'id' => 'dateFrom')); ?><br /><br /><br />

                  <?php  echo $this->Form->input('to', array('label' => 'Hasta' , 'type' => 'date', 'id' => 'dateTo')); ?>
        <div style="margin-top:60px;">
        Socios
        <INPUT TYPE=CHECKBOX NAME="sociosCheck" id="sociosCheck" checked="checked" /> <br />
        No Socios
        <INPUT TYPE=CHECKBOX NAME="noSociosCheck" id="noSociosCheck" checked="checked" />
        </div>
        <input class="buttonCakeLike" style="width:auto;float:left;margin:20px 0 20px 0;" type="button" value="Refrescar listado" id="refreshTicketsButton" />

    </div>

</div>
<div id="tableTicketsContainer" style="width: 75%;float: left;">
 <table style="border-left: solid 1px grey;" >
    <tr>
        
        <td>
            Id                
        </td>
        
        <td>
            Nombre de sala
        </td>
        
        <td>
            Importe ($)
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
              if(!empty($ticketsFromToday)) {
                  if($this->Session->read('SalaId')){
                    $numberOfTickets = 0;
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
                                <div style="float:left;margin-right:10px;">
                                        
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
                                </div>
                            </td>
                        </tr>
        <?php
                    }
              
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
            Total importe = $<?php echo $amountSize; ?>
        </td>
        
        <td>
            
        </td>
        
        <td>
            Total entradas = <?php if(!empty($ticketsFromToday)) {
                                            echo $numberOfTickets;
                                        }
                                        else{
                                            echo 0;
                                        }
                            ?> 
        </td>
        
    </tr>
    
    
</table>
</div>
    
