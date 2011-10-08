<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <p> Seleccionar Películas </p>
        <div id ="buscadorSeleccionarPelicula" >
           <?php echo $this->Form->create('Pelicula', array('action' => 'seleccionar_peliculas')); 
                 echo $this->Form->input('nombre');
                 echo $this->Form->end('Buscar');
           
           ?>
        </div>    
        <div id="contenedorPeliculas" >
           <ul>
                <li>Listado de películas</li>
                <?php
                  if(!empty($seleccionPelis)){
                      echo '<div id="contenedorPeliculasSP">';
                      echo '<li class="liTitulo"><div  >Nombre</div> <div>Duración</div> <div>Marcar</div> </li><br />';
                      foreach ($seleccionPelis as $peli){
                                  echo '<li class="liAlineados" ><div id="contenedorPelicula" ><div id="contenedorNombrePelicula" >'.$peli['Pelicula']['titulo']
                                       .'</div><div id="contenedorDuracionPelicula" > '.$peli['Pelicula']['duracion'].' </div> <div id="contenedorCheckearPelicula" >
                                           <input type="checkbox" class="peliculaSeleccionada" id="'.$peli['Pelicula']['id'].'" /></div>  
                                           </div></li> <br />';
                      }
                      echo '</div>';
                  }
                ?> 
                <input type="button" value="Activar seleccionadas" id="activarPeliculasSeleccionadas" />
           </ul>         
            
        </div>
        
    </body>
    
    
</html>
