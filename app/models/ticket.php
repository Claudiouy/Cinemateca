<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ticket extends AppModel{
    var $name = 'Ticket';
    var $belongsTo = array('Performance', 'Socio', 'Sala');
    
    
    function createSocioTicket($mySocioId, $performanceId){
        
        $ticketSold = false;
        if(!empty($mySocioId) ){
            
            $data = array('Ticket' => array('socio_id' => $mySocioId, 'performance_id' => $performanceId));
            if($this->save($data)) $ticketSold = true;
        }
        return $ticketSold;
    }
    
    function cRetrieveTickets($dateFrom, $dateTo){
        
        $conditions = array('Ticket.created >' => $dateFrom, 'Ticket.created <=' => $dateTo);
        $listOfTickets = $this->find('all', array('conditions' => $conditions));
        return $listOfTickets;
    }
}
?>
