<html>
    <head>
        <title></title>
    </head>
    
    <body>
        Agregar actor
        <div style="width:50%">
        <?php 
            echo $form->create('Actor', array('action' => 'new_actor'));
            echo $this->Form->input('name', array('label' => 'Nombre'));
            echo $this->Form->input('lastname', array('label' => 'Apellido'));
            echo $this->Form->input('birthdate', array('type' => 'date', 'label' => 'Fecha de nacimento'));
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
        </div>
    </body>
    
    
</html>