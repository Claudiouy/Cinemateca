<div>
    <h2 id="h2">Detalle de pago</h2>
    <?php
        if(!empty($detailedPayment)){

            $socioData = $detailedPayment['Socio']['name'].' '.$detailedPayment['Socio']['surname'];
            echo 'Socio: '.$this->Html->link(__($socioData, true), array('controller' => 'socios', 'action' => 'view', $detailedPayment['Socio']['id'])).'<br />';
            $paymentAmount = $detailedPayment['Payment']['amount'];

            echo 'Importe: $ '.$paymentAmount.'<br />';
        }
    ?>
    
</div>