<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <h2 style="margin-left:27%;margin-bottom: 50px;" >Listado de películas</h2>
        <div id ="buscadorSeleccionarPelicula" style="height:170px;" >
           <?php echo $this->Form->create('Pelicula', array('action' => 'seleccionar_peliculas')); 
                 echo $this->Form->input('nombre', array('style' => 'margin-bottom:10px;'));
                 echo $this->Form->end('Buscar',  array('style' => 'margin-right: 210px;'));
           
           ?>
        </div>    
        <div id="contenedorPeliculas" style="width:74%; " >
           <table>
                
                
                <?php
                  if(!empty($seleccionPelis)){
                      $i=0;
                      echo '<tr  ><td style="height:30px;" >Nombre</td> <td >Duración</td> <td  >Marcar</td> </tr>';
                      foreach ($seleccionPelis as $peli){ 
                          
                          ?>
                            
                                  <tr>
                                          <td >
                                            <?php echo $peli['Pelicula']['name'] ?>
                                          </td>
                                            <td  > 
                                                <?php echo $peli['Pelicula']['duracion'] ?>
                                            </td> 
                                            <td  >
                                                <input type="checkbox" <?php if($peli['Pelicula']['activa'] == 1) echo 'checked="checked"'; ?> class="peliculaSeleccionada" id="<?php echo $peli['Pelicula']['id'] ?>" /></div>  
                                            </td>
       
                                  
                  <?php    }
                      echo '</div>';
                  }
                  else{
                      echo 'No hay películas con esos datos';
                  }
                ?> 

           </table >        
            
        </div>
        
    </body>
    
    
</html>
