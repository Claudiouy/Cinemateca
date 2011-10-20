<html>
    <head>
        <title></title>
    </head>

    <body>
        <p style="padding-bottom: 15px;"> Listado de actores </p>
        
            <?php
            
                if(!empty($allActors)){
                    foreach ($allActors as $act) {
                        echo '·<a href="/cake_primero/actors/edit_actor/'.$act['Actor']['id'].'">'. $act['Actor']['name'].' '.$act['Actor']['lastname'].'</a> nacido el '.$act['Actor']['birthdate'].'    <a href="/actors/remove_actor/'.$act['Actor']['id'].'"  >Eliminar</a> <br />'; 
                    }
                }
            ?>
    </body>


</html>

