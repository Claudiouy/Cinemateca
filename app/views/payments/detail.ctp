<div>
    <h2 id="h2">Detalle de pago</h2>
    <?php
        if(!empty($detailedSocio)){
            
            $socioData = $detailedSocio['Socio']['name'].' '.$detailedSocio['Socio']['surname'];
            echo 'Socio: '.$this->Html->link(__($socioData, true), array('controller' => 'socios', 'action' => 'detail', $detailedSocio['Socio']['id'])).'<br />';
            $paymentAmount = $detailedSocio['Payment'][0]['amount'];
            echo 'Importe: $ '.$paymentAmount.'<br />';
        }
    ?>
    
</div>