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
                echo $this->Form->input('length_months', array('label' => 'Cantidad de meses que paga', 'value' => $my_suscription['Suscription']['length_months']));
                echo $this->Form->input('amount', array('label' => 'Importe de la cuota', 'value' => $my_suscription['Suscription']['amount']));
                echo $this->Form->input('description', array('type' => 'textarea','label' => 'Descripción' ,'value' => $my_suscription['Suscription']['description']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $my_suscription['Suscription']['id']));
                echo $this->Form->end('Actualizar');
            }   
        ?>
        </div>
    </body>
    
    
</html>
