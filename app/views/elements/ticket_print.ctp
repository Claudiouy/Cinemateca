<?php if(!empty($message)){
    //var_dump($message);
        if($message[0] == 'true'){  ?>
             <div><h2>Impresion de entrada</h2>Datos socio: <?php echo $message[1]['Socio']['name'].' '.$message[1]['Socio']['surname']?>  <br />Fecha y hora de la función: <?php echo $message[2]['Performance']['hora_comienzo'] . ' ' . $message[2]['Performance']['created'] ?> <br />Película: <?php echo $message[2]['Pelicula']['name']  ?></div>
            <?php    
        }
        else{     
            echo false;
        }
      }
      if(!empty($message_no_socio)){
          echo $message_no_socio;
          
      }
?>