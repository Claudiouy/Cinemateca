<div class="menu index">
   
	<h2 id="h2"><?php __('Menú Principal');?></h2>    


        <?php echo $this->Session->flash(); ?>


<div class="actions">
<ul>
<li>
<?php 
    if($this->Session->read('SalaId') ){
        if($this->Session->read('SalaId') != '-1'){
echo $this->Html->link('Boleteria', array(
    'controller' => 'tickets',
    'action' => 'ticket_socio',  
    )
    );
        }
        else{
            echo 'Para entrar en venta a sala debe seleccionar una sala';
        }
    }
    else{
        echo 'Para entrar en venta a sala debe seleccionar una sala';
    }
?>
</li>    
<li>
<?php 
echo $this->Html->link('Usuarios', array(
    'controller' => 'users',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Socios', array(
    'controller' => 'socios',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Colectivos', array(
    'controller' => 'socios',
    'action' => 'colectivos',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Peliculas', array(
    'controller' => 'peliculas',
    'action' => 'index',  
    )
    );
?>
</li>    
<li>

<?php 
echo $this->Html->link('Actores', array(
    'controller' => 'actors',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Directores', array(
    'controller' => 'directors',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Funciones', array(
    'controller' => 'performances',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
    if($this->Session->read('SalaId')){
        if($this->Session->read('SalaId') != '-1'){
echo $this->Html->link('Pagos', array(
    'controller' => 'payments',
    'action' => 'index',  
    )
    );
}
        else{
            echo 'Para entrar en pagos debe seleccionar una sala';
        }
    }
    else{
        echo 'Para entrar en pagos es necesario seleccionar una sala';
    }
?>
</li>
<li>
<?php 
echo $this->Html->link('Suscripciones', array(
    'controller' => 'suscriptions',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Salas', array(
    'controller' => 'salas',
    'action' => 'index',  
    )
    );
?>
</li>

</ul>
    
</div>
        
        
        <div>
            <div style="float:right;">
                <div>Sala</div>
                <select id="globalSalaId" name="globalSalaId" style="clear:none;float:right;">
                    <option value="-1" >Sin sala</option>
                <?php 
                        if(!empty($allSalas)){ 
                            foreach($allSalas as $sal){
                    ?>
                                <option <?php if($this->Session->read("SalaId") == $sal['Sala']['id']) echo 'selected="selected"'; ?> value="<?php echo $sal['Sala']['id']?>" ><?php echo $sal['Sala']['name'];?></option>
                
                    <?php   } 
                        }
                      
                      ?>
                </select>
            </div>
            <?php     
                    
                    ?>
        </div>   

</div>
