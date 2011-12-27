    <div id="list_of_socios" >
        <h2 style="width: 60%;background-color: #8BD;margin-left:10px;" >Resultados coincidentes</h2>
    <ul>
        <?php 
            if(!empty($socioList)){
                foreach ($socioList as $socio) {
                    
                
            ?>
                    <li>
                      
                       <?php echo $this->Html->link(__($socio['Socio']['name'].' '.$socio['Socio']['surname']. ', documento: ' . $socio['Socio']['documento_identidad']  , true), array('action' => 'retrieveSocioById', $socio['Socio']['id'])); ?>
                    </li>        
        
        <?php 
                }
            }
            ?>
        
        
        
    </ul>
     
    
    
</div>