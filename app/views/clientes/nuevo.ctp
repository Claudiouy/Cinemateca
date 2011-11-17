<html>
    <head>
        <title> </title>
    </head>
    <body>
        <h2 id="h2">Ingreso de usuario</h2>
        <br />
        <?php 
            echo $form->create('Cliente', array('action' => 'nuevo'));
            echo $this->Form->input('nombre', array('label' => 'Nombre'));
            echo $this->Form->input('apellido', array('label' => 'Apellido'));
            echo $this->Form->input('edad', array('label' => 'Edad'));
            echo $this->Form->end('Guardar');
        
        ?>
    </body>
    
</html>