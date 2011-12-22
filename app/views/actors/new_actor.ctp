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
            echo $form->input('birthdate',array('label' => 'Fecha de nacimento','maxYear' => date('Y', strtotime('+  0 years')),
                                  'minYear' => date('Y', strtotime('- 200 years')
                          )));
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
        </div>
    </body>
    
    
</html>