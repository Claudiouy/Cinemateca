<div class="index">


	<h2 id="h2"><?php __('Peliculas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
                        <th><?php echo $this->Paginator->sort('duración');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($peliculas as $peli):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $peli['Pelicula']['id']; ?>&nbsp;</td>
		<td><?php echo $peli['Pelicula']['name']; ?>&nbsp;</td>
                <td><?php echo $peli['Pelicula']['duracion']; ?> min &nbsp;</td>
	
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'editar_pelicula', $peli['Pelicula']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'eliminar_pelicula', $peli['Pelicula']['id']), null, sprintf(__('Esta Seguro de eliminar la película N° %s?', true), $peli['Pelicula']['id'])); ?>
		</td>
	</tr>
            <?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><input type="button" class="buttonCakeLike" value="Ingresar pelicula" id="openNewMovieButton" /></li>
                <li><?php echo $this->Html->link(__('Activar películas', true), array('action' => 'seleccionar_peliculas')); ?></li>
                
        </ul>
        
</div>

<div style="margin-left:45%;"><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	

<div id="newMovieContainer" style="width:50%;left: 20%;">
    
        <h2 class="tituloGraficas" >Agregar pelicula</h2>
        <div class="divCloseButtonContainer" >
            <?php echo $this->Html->image('closeButton2.jpg'); ?>
        </div>
    
        <div style="width:50%;float:left;">
        <?php 
            echo $form->create('Pelicula', array('action' => 'nueva_pelicula', 'type' => 'file'));
            echo $this->Form->input('name', array('label' => 'Título'));
            echo $this->Form->input('duracion', array('label' => 'Duración'));
            echo $this->Form->input('anio', array('label' => 'Año de estreno'));
            echo $this->Form->input('country', array('label' => 'Pais'));
            echo $this->Form->textarea('descripcion', array('label' => 'Descripcion', 'style' => 'margin-left:10px;'));
            echo $this->Form->input('activa', array('type' => 'checkbox', 'label' => 'Activa'));
            
            ?>
            <INPUT TYPE=FILE NAME="upfilePel" /><br />
            
            <?php
            
            echo $this->Form->end('Guardar');
        
        ?>
        <?php echo $this->Session->flash(); ?>
        </div>  
        
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
</div>
