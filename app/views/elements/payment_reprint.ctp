<?php
    if(!empty($myPayment)){
        //var_dump($myPayment);
        ?>
        <h1>Reimpresión de pago</h1><div>Reimpresión de pago nº: <?php echo $myPayment['Payment']['id']?><br />Importe total: $<?php echo $myPayment['Payment']['amount']?><br />Cantidad de cuotas: <?php echo $myPayment['Payment']['numbers_quotas']?><br />Socio: <?php echo $myPayment['Socio']['name']. ' ' .$myPayment['Socio']['surname'] ?></div>
    
        <?php
    }
?>
