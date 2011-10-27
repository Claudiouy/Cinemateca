<html>
    <head>
        <title></title>
    </head>
    
    <body>
        Agregar pelicula
        
        <?php 
            echo $form->create('Suscription', array('action' => 'new_suscription'));
            echo $this->Form->input('name', array('label' => 'Nombre'));
            echo $this->Form->input('description', array('label' => 'descripcion'));
            echo $this->Form->input('repeats_by_year', array('label' => 'Repeticiones por año'));
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
    </body>
    
    
</html>