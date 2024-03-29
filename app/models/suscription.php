<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Suscription extends AppModel{
    
    var $name = 'Suscription';
    
    var $validate = array(
        'name' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'Nombre  de suscripcion es un campo requerido'
             ),
        'length_months' => array(
                 'no_vacio' => array(   
                     'rule' => array('notEmpty'),     
                     'message' => 'Cantidad de meses que abona es un campo requerido'
                     
                 ),
                 'numerico' => array(
                     'rule' => 'numeric',      
                     'message' => 'Cantidad de meses que abona es un número'
                 ),
                 'mayor_cero' => array(
                     'rule' => array('comparison', '>', 0),
                     'message' => 'El campo mes es mayor a 0.' 
                     )
                 
             ),
        'amount' => array(
                 'no_vacio' => array(   
                      'rule' => array('notEmpty', array('comparison', '>', 0)),     
                     'message' => 'Cantidad de meses que abona es un campo requerido'
                     
                 ),
                 'numerico' => array(
                     'rule' => 'numeric',      
                     'message' => 'Cantidad de meses que abona es un número'
                 ),
                 'mayor_cero' => array(
                     'rule' => array('comparison', '>', 0),
                     'message' => 'El campo importe es mayor a 0.' 
                     )
                 
             )
    );
    
    public function cUpdateSuscription($suscriptionId, $suscriptionName, $suscriptionDescription, $suscriptionLengthMonths, $suscriptionAmount){
        
        $updatedOk = false;
        $fields = array('Suscription.name' => '"'.$suscriptionName.'"',
                        'Suscription.description' => '"'.$suscriptionDescription.'"' ,
                        'Suscription.amount' => $suscriptionAmount,
                        'Suscription.length_months' => $suscriptionLengthMonths);
        $conditions = array('Suscription.id' => $suscriptionId);
        
        if($this->updateAll($fields, $conditions) == true) $updatedOk = true;
        
        return $updatedOk;
    }
    
     public function safeDelete($suscriptionId){
        
        $safeDeleteOk = false;
        $fields = array('Suscription.deleted' => 1);
        $conditions = array('Suscription.id' => $suscriptionId);

        if($this->updateAll($fields, $conditions) == true) $safeDeleteOk = true;
        
        return $safeDeleteOk;
    }
    
    
}
?>
