<?php if(!empty($message)){
        if($message[0] == 'true'){  ?>
             <div><h2>Impresion de pago</h2>Datos socio: <?php echo $message[2]['Socio']['name'].' '.$message[2]['Socio']['surname']?> <br />Suscripción: <?php echo $message[1]['Suscription']['name'] ?> <br />Número de pagos: <?php echo $message[3] ?> <br />Meses pagos: <?php echo ((int)$message[1]['Suscription']['length_months'] * $message[3] ) ?><br />Importe total de pagos: <?php echo ( $message[3] * (int)$message[1]['Suscription']['amount'] ) ?></div>
            <?php    
        }
        else{     
            echo false;
        }
      }
?>
