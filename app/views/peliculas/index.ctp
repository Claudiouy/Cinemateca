<html>
    <head>        
        <style>
            
        </style>
        <title> </title>
    </head>
    <body>
        <ul>
            <li>Listado de películas</li>
            <?php
              if(!empty($pelis)){
                  foreach ($pelis as $peli) {
                      
                     echo '<div id="contenedorPeliculas">'.
                      
                      '<li class="liAlineados" ><div id="contenedorPelicula" ><div id="contenedorNombrePelicula" ><a href="/cake_primero/peliculas/editar_pelicula/'.$peli["Pelicula"]["id"].'" >'.$peli["Pelicula"]["titulo"]
                          .'</a></div><div id="contenedorDuracionPelicula" > '.$peli["Pelicula"]["duracion"].' </div> <div id="contenedorVerDetallePelicula" >   <a href="/cake_primero/peliculas/detalle/'.$peli["Pelicula"]["id"]
                             .'" class="links" >Ver detalle</a></div> </li> <br />';
                  }
              }
              
            ?>            
        </ul>
       <!-- <a href="/cake_primero/clientes/nuevo" class="links" >Ingresar cliente</a> -->
        <br />
        <br />
        
    </body>
       
</html>