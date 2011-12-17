<table id="ticketSocioContainer">
    <tr>
        <td>
            <div id="searchSocioTicketContainer">
                Ingrese el documento del cliente: <input type="text" id="socioDocument" />
                <input type="button" value="Buscar" id="findSocioByDoc" />

            </div>
        </td>
        
        <td>
               <div id="dataSocioTicketContainer" >
                   <?php echo $form->create('Ticket', array('action' => 'create_new_socio_ticket')); ?>
                    <div id="socioByDocResult">
                        Socio: <input type="text" readonly="readonly" id="inputReadOnlySocio" />
                            
                            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                    </div>
                </div>
            
        </td>    
    </tr>  
</table>

<<<<<<< HEAD:app/views/tickets/ticket_socio.ctp
<div style="margin-left:40%"> <?php echo $this->Form->end('Generar entrada'); ?> 
    <div style="float:right;">
                    <?php echo  $this->Html->link(__('Ingreso a no socio', true), array('action' => 'create_new_no_socio_ticket'), null, sprintf(__('¿Esta seguro de generar el pago?', true))); ?>
        </div> 
</div>
=======
<<<<<<< HEAD
<div style="margin-left:40%"> <?php echo $this->Form->end('Aplicar pago'); ?> </div>
=======
<div style="margin-left:40%"> <?php echo $this->Form->end('Generar entrada'); ?> </div>
>>>>>>> 536d3e85739a2ce271238b5b112a609159f356b2
>>>>>>> 85f128f48cc7106cdad0f6dc72bcba0844a40067:app/views/tickets/ticket_socio.ctp

    