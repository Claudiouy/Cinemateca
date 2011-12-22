<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TicketsController extends AppController{
    var $name = 'Tickets';
    var $components = array('RequestHandler');
    
    function index(){
        //aca se elige si es socio o no socio
    }
    
    function ticket_socio(){
        $this->loadModel('Performance');
        $listOfPerformances = $this->Performance->find('all');
        $this->set('allPerformances', $listOfPerformances);
        $this->Ticket->recursive = 2;
        $listOfTickets = $this->Ticket->find('all');
        $this->set('ticketsFromToday', $listOfTickets);
    }
    
    function retrieve_socio_by_document(){
        
        if(!empty($_POST["socioDoc"])){
            $this->loadModel('Socio');
            $this->Ticket->recursive = 1;
            $socioDoc = $_POST["socioDoc"];
            $mySocio = $this->Socio->getSocioByDocument($socioDoc);
            $this->set('my_socio', $mySocio);
            // seguir aca
        }
        $this->render('/elements/socio_by_doc');
    }
    
    function create_new_socio_ticket(){
        
        if(!empty($this->data['Ticket']['id']) && !empty($_POST["performanceIdForTicket"])){

            if($_POST["performanceIdForTicket"] != '-1'){
                $id_function = $_POST["performanceIdForTicket"];
                $my_id = $this->data['Ticket']['id'];
                $this->loadModel('Socio');
                if($this->Socio->cValidateSocioUpToDate($my_id)){
                    if($this->Ticket->createSocioTicket($my_id, $id_function)){
                        $this->redirect('/tickets');
                    }
                }
            }
        }     
        $this->redirect('/tickets/ticket_socio');
        
    }
    
    function create_new_no_socio_ticket(){
        
        if(!empty($this->params['pass']['0'])){
            $perf_id = $this->params['pass']['0'];
            if($perf_id != '-1'){
                $data = array('Ticket' => array('socio_id' => 0, 'amount_ticket' => 120, 'performance_id' =>  $perf_id)); //este amount_Ticket seria el propio de la funcion
                
                $this->Ticket->create();
                if($this->Ticket->save($data)){
                    $this->redirect('/tickets');
                }
                
            }
        } 
        $this->redirect('/tickets/ticket_socio');
    }
    
    function refresh_tickets(){
        if(!empty($_POST)){
          $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
          $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));

          if( $dateFrom <= $dateTo ){
             $this->Ticket->recursive = 2;
             $listOfTickets = $this->Ticket->cRetrieveTickets($dateFrom, $dateTo);
             if(!empty($listOfTickets)){
                 $this->set('ticketsFromToday', $listOfTickets);
             }
             
          }
        }
        $this->render('/elements/tickets_list');
        
    }
    
    function createTicketToPrint(){
        
    }
}


?>
