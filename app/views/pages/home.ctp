<div class="menu index">
   
	<h2 id="h2"><?php __('Menú Principal');?></h2>    


        <?php echo $this->Session->flash(); ?>


<div class="actions">
<ul>
<li>
<?php 
echo $this->Html->link('Gestion de Usuarios', array(
    'controller' => 'users',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Gestion de Socios', array(
    'controller' => 'socios',
    'action' => 'index',  
    )
    );
?>
</li>
<li>
<?php 
echo $this->Html->link('Colectivos de Socios', array(
    'controller' => 'socios',
    'action' => 'colectivos',  
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
echo $this->Html->link('Pagos', array(
    'controller' => 'payments',
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
                    <option value="-1" >Administrador</option>
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