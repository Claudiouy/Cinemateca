<html>
    <head>
        <title></title>
    </head>
    
    <body>
        Agregar pelicula
        
        <?php 
            echo $form->create('Suscription', array('action' => 'new_suscription'));
            echo $this->Form->input('name', array('label' => 'Nombre'));
            echo $this->Form->input('amount', array('label' => 'Importe'));
            echo $this->Form->input('length_months', array('label' => 'Cantidad de meses que paga'));
            echo $this->Form->input('description', array('type' => 'textarea','label' => 'Descripción'));
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
    </body>
    
    
</html>