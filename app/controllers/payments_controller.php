<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class PaymentsController extends AppController{
    var $name = 'Payments';
    var $helpers = array('FlashChart');    
    var $components = array('RequestHandler');  // para no mostrar header y footer cuando cargo un element
    
    /*
    function beforeFilter(){
        
        $user = $this->Session->read(USER_LOGIN_KEY); 
        $aco = $this->params['controller']; 
        if ($this->Acl->check($user, "/$aco", '*')) { 
            return;  
        }else{ 
            // if anonymous, redirect to login 
            // otherwise, give permission error 
            if( $user == ANONY_USER){ 
                $this->redirect("/authentications/login"); 
            }else{ 
                $this->redirect("/pages/permission_denied"); 
            } 
        } 
    }*/
    
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
            if($this->Payment->save($this->data['Payment'])){
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
            $this->loadModel('Socio');
            $this->loadModel('Suscription');
            $mySocio = $this->Socio->findById($rawPayment['idSocio']);
            
            if(!empty($mySocio)) {                
                $mySuscription = $this->Suscription->findById($mySocio['Socio']['suscription_id']);
                
                try{
                    if($this->Payment->cCreateNewPayment( $mySuscription, $rawPayment['idSocio'], $rawPayment['numberQuotas'])){

                        if($this->Socio->cUpdateSocioEffectiveDate($mySuscription, $mySocio, $rawPayment['numberQuotas'])){
                            $this->redirect('/payments');
                        }
                        else {
                            throw new Exception();
                        }

                    }
                    else {
                        throw new Exception();
                    }
                }
                catch(Exception $e){
                    
                }
            }
        }
        $this->redirect('/payments/new_payment');
    }
    
    function payment_filters(){
        
        if(!empty($_POST["nameSocio"]) || !empty($_POST["lastNameSocio"]) || !empty($_POST["ciSocio"]) || !empty($_POST["amountPayment"])){
            
            $this->Payment->recursive = 1;
            $paymentsByFilters = array();
            $innerConditions = array();
            
            if(!empty($_POST["nameSocio"])){
                $sociosByNameCondition = array('Socio.name LIKE' => '%'.$_POST["nameSocio"].'%');                
                $innerConditions = array_merge($innerConditions, $sociosByNameCondition);            
            }
            
            if(!empty($_POST["lastNameSocio"])){
                $sociosByLastNameCondition =  array('Socio.surname LIKE' => '%'.$_POST["lastNameSocio"].'%');
                $innerConditions = array_merge($innerConditions, $sociosByLastNameCondition);            
            }
            
            if(!empty($_POST["ciSocio"])){
                $socioByCiCondition = array('Socio.documento_identidad = ' => $_POST["ciSocio"]);
                $innerConditions = array_merge($innerConditions, $socioByCiCondition);                           
            }
            
            if(!empty($_POST["amountPayment"])){
                $amountCondition = array('Payment.amount = ' => $_POST["amountPayment"]);
                $innerConditions = array_merge($innerConditions, $amountCondition);
            }
            $paymentsByFilters = $this->Payment->find('all', array('conditions' => $innerConditions));
            
            $this->set('paymentsByFilters', $paymentsByFilters);
            $this->render('/elements/payments_socio');
        }
        else {
            if($this->RequestHandler->isAjax()){  // Si no carga el formulario en la seccion de pagos.
                $this->render('/elements/payments_socio');
            }
        }
        
    }
    
}
?>
