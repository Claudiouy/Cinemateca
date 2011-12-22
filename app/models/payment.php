<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Payment extends AppModel{
    var $name = 'Payment';
    var $belongsTo = 'Socio';
    var $actsAs = array('UtilDate');
    
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
    
    public function cCreateNewPayment($mySuscription, $mySocioId, $numberOfQuotas){
        
        $savedOk = false;
        $totalAmount = ($mySuscription['Suscription']['amount'] * $numberOfQuotas); 
        $data = array('Payment' => array('socio_id' => $mySocioId, 'amount' => $totalAmount, 'numbers_quotas' => $numberOfQuotas));
        if($this->save($data)){
            $savedOk = true;
        }
        return $savedOk;
    }

    public function cCancelPayment($paymentId){
        
        $canceledOk = false;
        $paymentToCancel = $this->findById($paymentId);
        
        $fields = array('Payment.canceled' => 1);
        $conditions = array('Payment.id' => $paymentId);
        
        $okUpdated = $this->updateAll($fields, $conditions);
        $this->create();
        $data = array('Payment' => array('socio_id' => $paymentToCancel['Payment']['socio_id'] , 'amount' => ($paymentToCancel['Payment']['amount'] * -1), 'id_canceled' => $paymentToCancel['Payment']['id'], 'created' => date('Y-m-d-H-i-s')));
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
    
    public function cGetMonthCount(){
        // revisar si se puede hacer un group by para traer los datos
        
        $conditions = array('Payment.created >= ' => '2011-01-01');

        $listOfPaymentsDate = $this->find('all', array('conditions' => $conditions));
        return $listOfPaymentsDate;
    }
    
    public function cPaymentChart(){
        
         $listP = $this->cGetMonthCount();
    }
    
    public function cGetFilteredPayments( $nameSocio, $lastNameSocio, $ciSocio, $amountPayment ){
        
        $this->recursive = 1;
        $innerConditions = array('Payment.deleted = ' => 0);

        if(!empty($nameSocio)){
            $sociosByNameCondition = array('Socio.name LIKE' => '%'.$nameSocio.'%');                
            $innerConditions = array_merge($innerConditions, $sociosByNameCondition);            
        }

        if(!empty($lastNameSocio)){
            $sociosByLastNameCondition =  array('Socio.surname LIKE' => '%'.$lastNameSocio.'%');
            $innerConditions = array_merge($innerConditions, $sociosByLastNameCondition);            
        }

        if(!empty($ciSocio)){
            $socioByCiCondition = array('Socio.documento_identidad = ' => $ciSocio);
            $innerConditions = array_merge($innerConditions, $socioByCiCondition);                           
        }

        if(!empty($amountPayment)){
            $amountCondition = array('Payment.amount = ' => $amountPayment);
            $innerConditions = array_merge($innerConditions, $amountCondition);
        }
        
        //$paymentsByFilters = array();
        //$paymentsByFilters = $this->find('all', array('conditions' => $innerConditions));
        return $innerConditions;
    }
   
    
}
?>
