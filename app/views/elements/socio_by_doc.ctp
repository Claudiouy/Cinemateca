    <?php if(!empty($my_socio)){
        echo $my_socio['Socio']['nombre']. ' '. $my_socio['Socio']['apellido'] . '--||--'.  $my_socio['Socio']['id'];
             } else {
                 echo 'No hay socios para ese documento'; } ?>    

