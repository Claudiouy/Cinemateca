<html>
    <head>
        <title></title>
    </head>
    
    <body>
        Agregar pelicula
        <div style="width:50%">
        <?php 
            echo $form->create('Pelicula', array('action' => 'nueva_pelicula'));
            echo $this->Form->input('name', array('label' => 'Título'));
            echo $this->Form->input('duracion', array('label' => 'Duración'));
            echo $this->Form->input('anio', array('label' => 'Año de estreno'));
            echo $this->Form->input('activa', array('type' => 'checkbox', 'label' => 'Activa'));
            
            ?>
            
            <?php
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
        </div>    
            
    </body>
    
    
</html>
