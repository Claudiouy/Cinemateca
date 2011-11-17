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

<div style="margin-left:40%"> <?php echo $this->Form->end('Aplicar pago'); ?> </div>

    