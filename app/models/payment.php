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
        $fields = array('Payment.deleted' => 1);
        $conditions = array('Payment.id' => $paymentId);

        if($this->updateAll($fields, $conditions) == true) $safeDeleteOk = true;
        
        return $safeDeleteOk;
    }
    
    public function cCreateNewPayment($socioId, $totalAmount){
        
        $savedOk = false;
        $data = array('Payment' => array('socio_id' => $socioId, 'amount' => $totalAmount));
        if($this->save($data)){
            $savedOk = true;
        }
        return $savedOk;
    }

    public function cCancelPayment($paymentId){
        
        $canceledOk = false;
        $paymentToCancel = $this->findById($paymentId);
        $data = array('Payment' => array('socio_id' => $paymentToCancel['Payment']['socio_id'] , 'amount' => ($paymentToCancel['Payment']['amount'] * -1), 'id_canceled' => $paymentToCancel['Payment']['id'] ));
        #var_dump($paymentToCancel);
        $fields = array('Payment.canceled' => 1);
        $conditions = array('Payment.id' => $paymentId);
        
        $okUpdated = $this->updateAll($fields, $conditions);
        $this->create();
        $okCreatedCanceled = $this->save($data);
        $canceledOk = $okUpdated && $okCreatedCanceled;
        return $canceledOk;
    }
    
    public function cGetPaymentsBySocioId($socioId){
        
        $conditions = array('Payment.socio_id = ' => $socioId);
        $paymentsBySocioId = $this->find('all', array('conditions' => $conditions));
        return $paymentsBySocioId;
    }
    
    public function cGetPaymentsBySocio($listOfSocios){
        
        $idsSocios = array();
        if(!empty($listOfSocios)){
            foreach ($listOfSocios as $socio) {
                $idsSocios[] = $socio["Socio"]["id"];
            }
        }
        $idsByCommas = implode('","', $idsSocios); //"in "no me aceptaba cake, ver si se puede hacer mas prolijo
        $conditions = 'Payment.socio_id IN ("' .$idsByCommas .'")';
        $listOfPaymentsByName = $this->find('all', array('conditions' => $conditions));
        return $listOfPaymentsByName;
    }
    
    public function cGetPaymentsByAmount($amount){
        
        $listOfPayments = array();
        if(!empty($amount)){
            $conditions = array('Payment.amount = ' => $amount);
            $listOfPayments = $this->find('all', array('conditions' => $conditions));
        }    
        
        return $listOfPayments;
    }

    
   
    
}
?>
