<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <h2 style="margin-left:40%;" >Listado de películas</h2>
        <div id ="buscadorSeleccionarPelicula" style="width:36%;float:left;height:500px;" >
           <?php echo $this->Form->create('Pelicula', array('action' => 'seleccionar_peliculas')); 
                 echo $this->Form->input('nombre', array('style' => 'margin-bottom:10px;'));
                 echo $this->Form->end('Buscar',  array('style' => 'margin-right: 210px;'));
           
           ?>
        </div>    
        <div id="contenedorPeliculas" style="width:100%" >
           <ul>
                
                
                <?php
                  if(!empty($seleccionPelis)){
                      $i=0;
                      echo '<div id="contenedorPeliculasSP">';
                      echo '<li class="liTitulo"><div  >Nombre</div> <div>Duración</div> <div>Marcar</div> </li><br />';
                      foreach ($seleccionPelis as $peli){ 
                          if($i > 9) break;
                          ?>
                            
                                  <li class="liAlineados" >
                                      <div id="contenedorPelicula" >
                                          <div id="contenedorNombrePelicula" >
                                            <?php echo $peli['Pelicula']['name'] ?>
                                          </div>
                                            <div id="contenedorDuracionPelicula" > 
                                                <?php echo $peli['Pelicula']['duracion'] ?>
                                            </div> 
                                            <div  id="contenedorCheckearPelicula" >
                                                <input type="checkbox" <?php if($peli['Pelicula']['activa'] == 1) echo 'checked="checked"'; ?> class="peliculaSeleccionada" id="<?php echo $peli['Pelicula']['id'] ?>" /></div>  
                                            </div>
                                  </li> 
                                  <br />
                  <?php  $i++;  }
                      echo '</div>';
                  }
                  else{
                      echo 'No hay películas con esos datos';
                  }
                ?> 
                <input style="width:auto" type="button" class ="buttonCakeLike" value="Activar seleccionadas" id="activarPeliculasSeleccionadas" />
           </ul>         
            
        </div>
        
    </body>
    
    
</html>
