<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar suscripción</h3>
        <div style="width:50%">
        <?php
            if(!empty($my_suscription)){
                echo $form->create('Suscription', array('action' => 'edit_suscription_proccess'));
                echo $this->Form->input('name', array('label' => 'Nombre' ,'value' => $my_suscription['Suscription']['name']));
                echo $this->Form->input('description', array('label' => 'Apellido' ,'value' => $my_suscription['Suscription']['description']));
                echo $this->Form->input('repeats_by_year', array('label' => 'Repeticiones por año', 'value' => $my_suscription['Suscription']['repeats_by_year']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $my_suscription['Suscription']['id']));
                echo $this->Form->end('Actualizar');
            }   
        ?>
        </div>
    </body>
    
    
</html>
