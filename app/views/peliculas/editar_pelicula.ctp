<html>
    <head>
        <title></title>
    </head>
    
    <body>
        
        <h3>Editar película</h3>
        <div style="width:50%">
        <?php
            if(!empty($mi_pelicula)){
                echo $form->create('Pelicula', array('action' => 'editar_pelicula', 'type'=>'file'));
                echo $this->Form->input('name', array('value' => $mi_pelicula['Pelicula']['name']));
                echo $this->Form->input('duracion', array('value' => $mi_pelicula['Pelicula']['duracion']));
                echo $this->Form->input('anio', array('value' => $mi_pelicula['Pelicula']['anio']));
                echo $this->Form->input('country', array('value' => $mi_pelicula['Pelicula']['country'], 'label' => 'Pais'));
                echo $this->Form->textarea('descripcion', array('value' => $mi_pelicula['Pelicula']['descripcion'], 'label' => 'Descripcion'));
                echo $this->Form->input('activa', array('type' => 'checkbox', 'label' => 'Activa', 'value' => $mi_pelicula['Pelicula']['activa']));
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $mi_pelicula['Pelicula']['id']));
                echo $this->Html->image('imgPelis/'.$mi_pelicula['Pelicula']['image_path'], array('style' => 'width:200px;height:200px;float:left;clear:both;')); 
                ?>
                <INPUT TYPE=FILE NAME="upfilePel" /><br />
                <div style="width:50%;float:left;" >
            Actores <br />
            <select id="actorsSelectId" name="actorsSelectId" style="margin-bottom:30px;">
                <option value="-1" >None</option>
                <?php if(!empty($allAct)){
                            foreach ($allAct as $act){ ?>
                                <option value="<?php echo $act['Actor']['id']; ?>" ><?php echo $act['Actor']['name']. ' ' .$act['Actor']['lastname']; ?></option>                                
                     <?php  }
                        }?>
            </select><br />
            
            Directores <br />
            <select id="dirSelectId" name="dirSelectId" >
                <option value="-1" >None</option>
                <?php if(!empty($allDir)){
                            foreach ($allDir as $dir){ ?>
                                <option value="<?php echo $dir['Director']['id']; ?>" ><?php echo $dir['Director']['name']. ' ' .$dir['Director']['surname']; ?></option>                                
                     <?php  }
                        }?>
            </select>
        </div>
            <?php
                echo $this->Form->end('Actualizar');
            }
        ?>
        <?php echo $this->Session->flash(); ?>
        </div>    
    </body>
    
    
</html>
