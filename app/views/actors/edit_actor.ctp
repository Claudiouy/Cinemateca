<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar actor</h3>
        <div style="width:50%">
        <?php
            if(!empty($my_actor)){
                echo $form->create('Actor', array('action' => 'edit_actor_proccess', 'type' => 'file'));
                echo $this->Form->input('name', array('label' => 'Nombre' ,'value' => $my_actor['Actor']['name']));
                echo $this->Form->input('lastname', array('label' => 'Apellido' ,'value' => $my_actor['Actor']['lastname']));
                echo $this->Form->input('nacionality', array('label' => 'Nacionalidad' ,'value' => $my_actor['Actor']['nacionality']));
                echo $this->Form->input('birthdate', array( 'type' => 'date', 'value' => $my_actor['Actor']['birthdate']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $my_actor['Actor']['id']));
                echo $this->Html->image('imgPelis/'.$my_actor['Actor']['image_path'], array('style' => 'width:200px;height:200px;float:left;clear:both;'));
                ?>
                <INPUT TYPE=FILE NAME="upfile" /><br />
            <?php
                echo $this->Form->end('Actualizar');
            }   
        ?>
        </div>
    </body>
    
    
</html>

