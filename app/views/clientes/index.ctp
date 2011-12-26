<html>
    <head>        
        <style>
            .links{
                text-decoration: none;
            }
        </style>
        <title> </title>
    </head>
    <body>
        <ul>
            <li>Listado de clientes</li>
            <?php
              if(!empty($clientela)){  
                  foreach ($clientela as $cli) {
                     echo '<li>'.$cli["Cliente"]["nombre"].' '.$cli["Cliente"]["apellido"]
                          .',  edad: '.$cli["Cliente"]["edad"].'    <a href="/cake_primero/clientes/eliminar/'.$cli["Cliente"]["id"].'" class="links" >Eliminar</a>    '
                          . '<a href="/cake_primero/clientes/editar/'.$cli["Cliente"]["id"].'" class="links">Editar</a></li>';
                  }
              }
              
            ?>            
        </ul>
        <a href="/cake_primero/clientes/nuevo" class="links" >Ingresar cliente</a>
        <br />
        <br />
        
    </body>
       
</html>