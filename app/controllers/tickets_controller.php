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
        if($this->Session->read('SalaId')){
            if($this->Session->read('SalaId') != '-1'){
                $this->loadModel('Performance');
                $conditions = array('Performance.sala_id = ' => $this->Session->read('SalaId'));
                $listOfPerformances = $this->Performance->find('all', array('conditions' => $conditions));
                $this->set('allPerformances', $listOfPerformances);
                $this->Ticket->recursive = 2;
                $conditions2 = array('Performance.sala_id = ' => $this->Session->read('SalaId'));
                $listOfTickets = $this->Ticket->find('all', array('conditions' => $conditions2));
                $this->set('ticketsFromToday', $listOfTickets);
            }
            else{
                $this->Session->setFlash('Para entrar en venta de entradas debe seleccionar una sala', 'default');
                $this->redirect('/');
            }
            
        }
        else{
            $this->Session->setFlash('Para entrar en venta de entradas debe seleccionar una sala', 'default');
            $this->redirect('/');
        }
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
        
        $mess= 'false|||No se ingresó algun dato obligatorio';
        
        if(!empty($_POST['ticketId']) && !empty($_POST["performanceIdForTicket"])){

            if($_POST["performanceIdForTicket"] != '-1'){
                $id_function = $_POST["performanceIdForTicket"];
                $my_id = $_POST['ticketId'];
                $this->loadModel('Socio');
                if($this->Socio->cValidateSocioUpToDate($my_id)){
                    $mySocio = $this->Socio->findById($my_id);
                    if($this->Ticket->createSocioTicket($my_id, $id_function)){
                        $this->loadModel('Performance');
                        $myFunction = $this->Performance->findById($id_function);
                        $mess = array('true', $mySocio, $myFunction );
                    }
                }
                else{
                    $mess = 'false|||El socio no se encuentra al día';
                }
            }
        }
        $this->set('message', $mess);
        $this->render('/elements/ticket_print');
        return false;
        
    }
    
    function create_new_no_socio_ticket(){
        
        if(!empty($_POST['idPerf'])){
            $perf_id = $_POST['idPerf'];
            if($perf_id != '-1'){
                $data = array('Ticket' => array('socio_id' => 0, 'amount_ticket' => 120, 'performance_id' =>  $perf_id)); //este amount_Ticket seria el propio de la funcion
                $this->loadModel('Performance');
                $myPerf = $this->Performance->findById($perf_id);
                $this->Ticket->create();
                if($this->Ticket->save($data)){
                    $this->Session->setFlash('La entrada se realizó correctamente');
                    $message_no_socio = 'Importe: $'. $data['Ticket']['amount_ticket'].'<br />'. 'Funcion: '. $myPerf['Sala']['name'].'<br /> Fecha: '. date('Y-m-d');
                }
                else{
                    $this->Session->setFlash('La entrada no se realizó correctamente');
                    $message_no_socio = 'false||La entrada no se realizó correctamente';
                }
                
            }
            else{
                $this->Session->setFlash('La función no puede ser vacía');
                $message_no_socio = 'false||La función no puede ser vacía';
            }
        }
        else{
            $this->Session->setFlash('La función no puede ser vacía');
        }
        $this->set('message_no_socio', $message_no_socio);
        $this->render('/elements/ticket_print');
    }
    
    function refresh_tickets(){
        if(!empty($_POST)){
            if($this->Session->read('SalaId')){
                  $socioCh = $_POST['socioC'];
                  $noSocioCh = $_POST['noSocioC'];
                  echo $socioCh;
                  echo $noSocioCh;
                  $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
                  $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));

                  if( $dateFrom <= $dateTo ){
                     $this->Ticket->recursive = 2;
                     $listOfTickets = $this->Ticket->cRetrieveTickets($dateFrom, $dateTo, $this->Session->read('SalaId'), $socioCh, $noSocioCh);
                     if(!empty($listOfTickets)){
                         $this->set('ticketsFromToday', $listOfTickets);
                     }

                  }
            }
        }
        $this->render('/elements/tickets_list');
        
    }
    
    function createTicketToPrint(){
        
    }
    
    function getTicketById(){
        
        if(!empty($_POST['idTicket'])){
            $myTicket = $this->Ticket->findById($_POST['idTicket']);
            $this->set('myTicket', $myTicket);
        }
        $this->render('/elements/ticket_reprint');
        return false;
    }
    
    function cancelTicket(){
        
         
        if(!empty($this->params['pass']['0'])){
            
            $ticket_id_to_cancel = $this->params['pass']['0'];
            if($this->Ticket->cCancelTicket($ticket_id_to_cancel)){
                $this->Session->setFlash('La entrada se anuló correctamente');
                $this->redirect('ticket_socio');
            }
            else{
                $this->Session->setFlash('La entrada no se anuló');
            }
        }
        $this->Session->setFlash('Error inesperado.');
        $this->redirect('ticket_socio');
    }
}


?>
