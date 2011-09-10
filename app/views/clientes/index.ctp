<html>
    <head>
        <title> </title>
    </head>
    <body>
        <ul>
            <li>Listado de clientes</li>
            <?php
              foreach ($clientela as $cli) {
                 echo '<li>'.$cli["Cliente"]["nombre"].' '.$cli["Cliente"]["apellido"].'</li>';
              }
              
            ?>            
        </ul>
    </body>
    
</html>