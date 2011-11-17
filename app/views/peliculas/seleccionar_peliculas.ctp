<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <p> Seleccionar Películas </p>
        <div id ="buscadorSeleccionarPelicula" style="width:50%" >
           <?php echo $this->Form->create('Pelicula', array('action' => 'seleccionar_peliculas')); 
                 echo $this->Form->input('nombre');
                 echo $this->Form->end('Buscar');
           
           ?>
        </div>    
        <div id="contenedorPeliculas" style="width:100%" >
           <ul>
                <h2>Listado de películas</h2>
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
                                            <?php echo $peli['Pelicula']['titulo'] ?>
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
                ?> 
                <input style="width:50%" type="button" value="Activar seleccionadas" id="activarPeliculasSeleccionadas" />
           </ul>         
            
        </div>
        
    </body>
    
    
</html>
