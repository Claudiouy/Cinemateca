    <div id="list_of_socios" >

    <ul>
        <?php 
            if(!empty($socioList)){
                foreach ($socioList as $socio) {
                    
                
            ?>
                    <li>
                      
                       <?php echo $this->Html->link(__($socio['Socio']['nombre'].' '.$socio['Socio']['apellido']  , true), array('action' => 'retrieveSocioById', $socio['Socio']['id'])); ?>
                    </li>        
        
        <?php 
                }
            }
            ?>
        
        
        
    </ul>
     
    
    
</div>