<html>
    <head>
        <title> </title>
    </head>
    <body>
        <h2>Login de usuario</h2>
        <br />
        <?php 
            echo $form->create('Usuario', array('controller' => 'usuarios', 'action' => 'login'));
            echo $this->Form->input('nombre', array('label' => 'nombre'));
            echo $this->Form->input('pass', array('label' => 'password'));
            echo $this->Form->end('Guardar');
        
        ?>
    </body>
    
</html>