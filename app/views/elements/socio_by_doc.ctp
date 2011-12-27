    <?php if(!empty($my_socio)){
        echo $my_socio['Socio']['name']. ' '. $my_socio['Socio']['surname'] . '--||--'.  $my_socio['Socio']['id'];

             } else {
                 echo 'No existe socio'; } ?>    

