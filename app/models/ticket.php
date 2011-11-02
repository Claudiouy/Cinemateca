<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ticket extends AppModel{
    var $name = 'Ticket';
    //var $belongsTo = 'Function';
    var $hasOne = 'Socio';
    
    
    function createSocioTicket($mySocioId){
        
        $ticketSold = false;
        if(!empty($mySocioId)){
            //falta if preguntando al modelo socio si el cliente esta al dia
            $data = array('Ticket' => array('socio_id' => $mySocioId));
            if($this->save($data)) $ticketSold = true;
        }
        return $ticketSold;
    }
}
?>
