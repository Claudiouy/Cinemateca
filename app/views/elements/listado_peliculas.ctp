<div>
<?php
      if(!empty($listadoFiltrado)){
          
          echo '<div id="contenedorPeliculasSP">';
          echo '<li class="liTitulo"><div  >Nombre</div> <div>Duración</div> <div>Marcar</div> </li><br />';
          foreach ($listadoFiltrado as $peli){
                            #var_dump($peli);
                            echo '<li class="liAlineados" ><div id="contenedorPelicula" ><div id="contenedorNombrePelicula" >'.$peli['Pelicula']['titulo']
                           .'</div><div id="contenedorDuracionPelicula" > '.$peli['Pelicula']['duracion'].' </div> <div id="contenedorCheckearPelicula" >
                               <input type="checkbox" class="peliculaSeleccionada" id="'.$peli['Pelicula']['id'].'" /></div>  
                               </div></li> <br />';
          }
          echo '</div>';
      }
?>
</div> 