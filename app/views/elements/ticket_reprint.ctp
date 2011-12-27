<?php
    if(!empty($myTicket)){
        //var_dump($myTicket);
        ?>
        <h1>Reimpresión de entrada</h1><div>Reimpresión de entrada nº: <?php echo $myTicket['Ticket']['id']?><br />Fecha: $<?php echo $myTicket['Ticket']['created']?><br /><?php if($myTicket['Ticket']['amount_ticket'] != 0){ ?> Importe: $<?php echo $myTicket['Ticket']['amount_ticket'];?><br /><?php } else { ?>Socio: <?php echo $myTicket['Socio']['name']. ' ' .$myTicket['Socio']['surname']; }?></div>
    
        <?php
    }
?>
