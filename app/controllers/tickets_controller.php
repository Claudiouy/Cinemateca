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
        
        if(!empty($this->data['Ticket']['id'])){
            $my_id = $this->data['Ticket']['id'];
            $this->loadModel('Socio');
            
            if($this->Socio->cValidateSocioUpToDate($my_id)){
                if($this->Ticket->createSocioTicket($my_id)){
                    $this->redirect('/tickets');
                }
                else{
                    $this->redirect('/tickets/ticket_socio');
                }
            }
            else{
                    $this->redirect('/tickets/ticket_socio');
            }
        }
        else{
            $this->redirect('/tickets/ticket_socio');
        }
    }
    
    function create_new_no_socio_ticket(){
        
        $data = array('Ticket' => array('socio_id' => 0, 'amount_ticket' => 120)); //este amount_Ticket seria el propio de la funcion
        $this->Ticket->save($data);
        $this->redirect('/tickets');

    }
}


?>
