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
    
    function cRetrieveTickets($dateFrom, $dateTo, $salaId, $socioCh, $noSocioCh){
        if(!empty($salaId)){
            $conditions = array('Ticket.created >=' => $dateFrom, 'Ticket.created <=' => $dateTo, 'Performance.sala_id' => $salaId);
            
            if(!empty($socioCh) && !empty($noSocioCh)){
                if($socioCh == 'false') $conditions[] = array('Ticket.socio_id > ' => '0');
                if($noSocioCh == 'false') $conditions[] = array('Ticket.socio_id = ' => '0');
            }
            $listOfTickets = $this->find('all', array('conditions' => $conditions, 'order' => array('Ticket.created' => 'desc')));
        }
        return $listOfTickets;
    }
    
    public function cCancelTicket($ticketId){
        
        $canceledOk = false;
        $ticketToCancel = $this->findById($ticketId);
        
        $fields = array('Ticket.canceled' => 1);
        $conditions = array('Ticket.id' => $ticketId);
        
        $okUpdated = $this->updateAll($fields, $conditions);
        $this->create();
        $data = array('Ticket' => array('socio_id' => $ticketToCancel['Ticket']['socio_id'] , 'amount_ticket' => ($ticketToCancel['Ticket']['amount_ticket'] * -1), 'id_canceled' => $ticketToCancel['Ticket']['id'], 'created' => date('Y-m-d-H-i-s'), 'performance_id' => $ticketToCancel['Ticket']['performance_id'], 'sala_id' => $ticketToCancel['Ticket']['sala_id']));
        $okCreatedCanceled = $this->save($data);
        $canceledOk = $okUpdated && $okCreatedCanceled;
        return $canceledOk;
    }
}
?>
