<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class PaymentsController extends AppController{
    var $name = 'Payments';
    
    var $components = array('RequestHandler');  // para no mostrar header y footer cuando cargo un element
    
    function index(){
        $this->Payment->recursive = 0;
        $conditions = array('Payment.deleted = ' => 0);
        $this->set('allPayments', $this->paginate('Payment', $conditions));
    }
    
    function detail(){
        if(!empty($this->params['pass']['0'])){
            $this->loadModel('Socio');
            $this->Payment->recursive = 1;
            $payment = $this->Payment->find('first', array('conditions' => array('Payment.id ' => $this->params['pass']['0'])));
            $this->set('detailedPayment', $payment);
        }
        else{
            $this->redirect('/payments');
        }
    }
    
    function new_payment(){
        if(!empty($this->data['Payment'])){
            if($this->Actor->save($this->data['Payment'])){
                $this->Session->setFlash('El pago se realizó correctamente', 'default');   
                $this->redirect('/payments');
            }
            else {
                $this->Session->setFlash('Error al realizar el pago', 'default');
            }
        }
    }
    
    function edit_payment(){
        if(!empty($this->params['pass']['0'])){
            $my_payment = $this->Payment->findById($this->params['pass']['0']);
            $this->set('my_payment', $my_payment);
        }
        else{
            $this->redirect('/payments');
        }
    }
    
    function edit_payment_proccess(){
        if(!empty($this->data['Payment'])){
            $correctly_updated = $this->Actor->cUpdatePayment($this->data['Payment']['id'], $this->data['Payment']['name'], $this->data['Payment']['lastname'], $this->data['Payment']['birthdate']);
            if($correctly_updated){
                $this->Session->setFlash('El pago se realizó correctamente', 'default');
                $this->redirect('/payments');
            }
            else{
                $this->Session->setFlash('Error al realizar el pago', 'default');
                $this->redirect('/payments/edit_payment/'.$this->data['Payment']['id']);
            }
        }
        else{
            $this->redirect('/payments');
        }
    }
    
    function remove_payment(){
        
        if(!empty($this->params['pass']['0'])){
            
            $payment_id_to_delete = $this->params['pass']['0'];
            
            if(!$this->Payment->safeDelete($payment_id_to_delete)){
                $this->Session->setFlash('Error al eliminar el pago');
                $allPayments = $this->find('all');
            }
        }
        $this->redirect('/payments');
    }
    
    function cancel_payment(){
        
        if(!empty($this->params['pass']['0'])){
            $payment_id_to_cancel = $this->params['pass']['0'];
            if($this->Payment->cCancelPayment($payment_id_to_cancel)){
                $this->Session->setFlash('El pago se anuló correctamente');
            }
            else{
                $this->Session->setFlash('El pago no se pudo anular');
            }
        }
        $this->redirect('/payments');
    }
    
    
    function retrieveSociosByName(){
        
        if(!empty($_POST["nameSocio"])){
            $socioName = $_POST["nameSocio"];
            $this->loadModel('Socio');
            $this->Payment->recursive = 1;
            $conditions = array('OR' => array('Socio.name LIKE' => '%'.$socioName.'%',
                                                'Socio.surname LIKE' => '%'.$socioName.'%'));
            //$conditions = array('Socio.id' => 1);
            //$conditions = 'Socio.apellido LIKE %'.$socioName.'%';
                                                
            $socioList = $this->Socio->find('all', array('conditions' => $conditions));
            //var_dump($socioList);
            $this->set('socioList', $socioList);
            
        }
        $this->render('/elements/socios_list');
        //$this->layout = 'layout_list_socios';
    }
    
    function retrieveSocioById(){
        if(!empty($this->params['pass']['0'])){        
            $idSocio = $this->params['pass']['0'];
            $this->loadModel('Socio');
            $this->Payment->recursive = 1;
            $selSocio = $this->Socio->findById($idSocio);
            $socioPayments = $selSocio["Payment"];
            if( sizeOf($socioPayments) > 0 )  $this->set('paymentsSocio', $socioPayments);
            #var_dump($socioPayments);
            $this->set('selSocio', $selSocio);
        }
        $this->render('/payments/new_payment');
    }
    
    function set_payment(){
        if(!empty($this->data['Payment'])){
            $rawPayment = $this->data['Payment'];
            if($this->Payment->cCreateNewPayment($rawPayment['idSocio'], $rawPayment['amountSocio'])){
                $this->redirect('/payments');
            }
        }
        $this->redirect('/payments/new_payment');
    }
    
    function payment_filters(){
        if(!empty($_POST["nameSocio"]) || !empty($_POST["lastNameSocio"]) || !empty($_POST["ciSocio"]) || !empty($_POST["amountPayment"])){
            
            $this->loadModel('Socio');
            $this->Payment->recursive = 1;
            $sociosIds = array();
            $paymentsByFilters = array();
            
            if(!empty($_POST["nameSocio"])){
                $sociosByName = $this->Socio->getSociosByName($_POST["nameSocio"]);
                $paymentsByName = $this->Payment->cGetPaymentsBySocio($sociosByName);
                if(!empty($paymentsByName)) $paymentsByFilters = array_merge($paymentsByFilters, $paymentsByName);            
            }
            
            if(!empty($_POST["lastNameSocio"])){
                $sociosByLastName = $this->Socio->getSociosByName($_POST["lastNameSocio"]);
                $paymentsByLastName = $this->Payment->cGetPaymentsBySocio($sociosByLastName);
                if(!empty($paymentsByLastName)) $paymentsByFilters = array_merge($paymentsByFilters, $paymentsByLastName);            
            }
            
            if(!empty($_POST["ciSocio"])){
                $socioByCi = $this->Socio->getSocioByDocument($_POST["ciSocio"]);
                $socioId = $socioByCi['Socio']['id'];
                $listPaymentsByName = $this->Payment->cGetPaymentsBySocioId($socioId);
                
                if(!empty($listPaymentsByName)) $paymentsByFilters = array_merge($paymentsByFilters, $listPaymentsByName);                           
            }
            
            if(!empty($_POST["amountPayment"])){
                $amount = $_POST["amountPayment"];
                $paymentsByAmount = $this->Payment->cGetPaymentsByAmount($amount);
                
                if(!empty($paymentsByAmount)) $paymentsByFilters = array_merge($paymentsByFilters, $paymentsByAmount);                
            }
            $this->set('paymentsByFilters', $paymentsByFilters);
            $this->render('/elements/payments_socio');
        }
        
    }
    
}
?>