<div class="menu index">
   
	<h2 id="h2"><?php __('Menú Principal');?></h2>    


        <?php echo $this->Session->flash(); ?>


<div class="actions">
<ul>
<li>
<?php 
echo $this->Html->link('Boleteria', array(
    'controller' => 'tickets',
    'action' => 'ticket_socio',  
    )
    );
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
echo $this->Html->link('Pagos', array(
    'controller' => 'payments',
    'action' => 'index',  
    )
    );
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
