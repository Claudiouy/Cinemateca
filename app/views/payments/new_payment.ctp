<div>
    

    <div style="width:50%;" ><input type="button" id="openSearchSocio" value="Buscar cliente" /> </div>
    <div id="selectedSocio">
               <?php if(!empty($selSocio)) {
                  echo $form->create('Payment', array('action' => 'set_payment')); 
                  echo 'El pago se efectuará para el cliente: '.$selSocio["Socio"]["name"]. ' ' . $selSocio["Socio"]["surname"] ; 
               echo $this->Form->input('idSocio', array('type' => 'hidden', 'value' => $selSocio["Socio"]["id"])); ?>
               
           <div style="width:50%;" >    <div id="amountContainer">
                   Ingrese importe: <?php echo $this->Form->input('amountSocio', array('type' => 'text')); ?>
               </div> </div>
               <?php echo $this->Form->end('Aplicar pago'); }?>
    </div>
    
    <div id="searchSocioContainer" style="color:red;">
        Busqueda por socio
        <input type="text" id="socioNameSearch" />
        <input type="button" value="Consultar" id="retrieveSocios" />        
        <div id="socioData">
                
        </div>
    </div>
    
    
</div>
