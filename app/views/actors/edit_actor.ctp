<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar actor</h3>
        <?php
            if(!empty($my_actor)){
                echo $form->create('Actor', array('action' => 'edit_actor_proccess'));
                echo $this->Form->input('name', array('label' => 'Nombre' ,'value' => $my_actor['Actor']['name']));
                echo $this->Form->input('lastname', array('label' => 'Apellido' ,'value' => $my_actor['Actor']['lastname']));
                echo $this->Form->input('birthdate', array('label' => 'Fecha de nacimiento' , 'type' => 'date', 'value' => $my_actor['Actor']['birthdate']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $my_actor['Actor']['id']));
                echo $this->Form->end('Actualizar');
            }   
        ?>
        
    </body>
    
    
</html>

