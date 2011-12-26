<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar cliente</h3>
        <?php
            if(!empty($mi_cliente)){
                echo $form->create('Cliente', array('action' => 'editar'));
                echo $this->Form->input('nombre', array('value' => $mi_cliente['Cliente']['nombre']));
                echo $this->Form->input('apellido', array('value' => $mi_cliente['Cliente']['apellido']));
                echo $this->Form->input('edad', array('value' => $mi_cliente['Cliente']['edad']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $mi_cliente['Cliente']['id']));
                echo $this->Form->end('Actualizar');
            }
        ?>
    </body>
    
    
</html>
