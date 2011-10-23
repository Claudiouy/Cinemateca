<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Payment extends AppModel{
    var $name = 'Payment';
    var $belongsTo = 'Socio';
    
    
   /* public function getSocio($socioId){
        $this->loadModel('Socio');
        $paymentSocio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $socioId)));
        return $paymentSocio;        
    }*/
    
    public function safeDelete($paymentId){
        
        $safeDeleteOk = false;
        $fields = array('Payment.canceled' => 1);
        $conditions = array('Payment.id' => $paymentId);

        if($this->updateAll($fields, $conditions) == true) $safeDeleteOk = true;
        
        return $safeDeleteOk;
    }
    
}
?>
