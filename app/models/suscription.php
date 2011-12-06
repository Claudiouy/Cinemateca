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
             )    
    );
    
    public function cUpdateSuscription($suscriptionId, $suscriptionName, $suscriptionDescription, $suscriptionLengthMonths){
        
        $updatedOk = false;
        $fields = array('Suscription.name' => '"'.$suscriptionName.'"',
                        'Suscription.description' => '"'.$suscriptionDescription.'"' ,
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
