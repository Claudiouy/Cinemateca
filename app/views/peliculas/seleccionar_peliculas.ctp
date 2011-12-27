<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <h2 style="margin-left:27%;margin-bottom: 50px;" >Listado de películas</h2>
        <div id ="buscadorSeleccionarPelicula"  >
           <?php echo $this->Form->create('Pelicula', array('action' => 'seleccionar_peliculas')); 
                 echo $this->Form->input('nombre', array('style' => 'margin-bottom:10px;'));
                 echo $this->Form->end('Buscar',  array('style' => 'margin-right: 210px;'));
           
           ?>
        </div>    
        <div id="contenedorPeliculas" style="width:150%" >
           <ul style="list-style-type: none;" >
                
                
                <?php
                  if(!empty($seleccionPelis)){
                      $i=0;
                      echo '<div id="contenedorPeliculasSP">';
                      echo '<li class="liTitulo" " ><div style="height:30px;" >Nombre</div> <div style="height:30px;" >Duración</div> <div style="height:30px;" >Marcar</div> </li><br />';
                      foreach ($seleccionPelis as $peli){ 
                          
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
                  <?php    }
                      echo '</div>';
                  }
                  else{
                      echo 'No hay películas con esos datos';
                  }
                ?> 

           </ul>         
            
        </div>
        
    </body>
    
    
</html>
