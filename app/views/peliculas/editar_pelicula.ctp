<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar película</h3>
        <?php
            if(!empty($mi_pelicula)){
                echo $form->create('Pelicula', array('action' => 'editar_pelicula'));
                echo $this->Form->input('titulo', array('value' => $mi_pelicula['Pelicula']['name']));
                echo $this->Form->input('duracion', array('value' => $mi_pelicula['Pelicula']['duracion']));
                echo $this->Form->input('anio', array('value' => $mi_pelicula['Pelicula']['anio']));
                echo $this->Form->input('activa', array('type' => 'checkbox', 'label' => 'Activa', 'value' => $mi_pelicula['Pelicula']['activa']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $mi_pelicula['Pelicula']['id']));
                echo $this->Form->end('Actualizar');
            }
        ?>
        <?php echo $this->Session->flash(); ?>
    </body>
    
    
</html>
