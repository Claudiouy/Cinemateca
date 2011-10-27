<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class PaymentsController extends AppController{
    var $name = 'Payments';
    
    function index(){
        $this->Payment->recursive = 0;
        $conditions = array('Payment.deleted = ' => 0);
        $this->set('allPayments', $this->paginate('Payment', $conditions));
    }
    
    function detail(){
        if(!empty($this->params['pass']['0'])){
            $this->loadModel('Socio');
            $this->Payment->recursive = 1;
            $socioIdList = $this->Payment->find('list', array('conditions' => array('Payment.socio_id' => $this->params['pass']['0'])));
            $socioId = $socioIdList[$this->params['pass']['0']];            
            $my_socio = $this->Socio->find('first', array('conditions' => array('Socio.id' => $socioId)));
            $this->set('detailedSocio', $my_socio);
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
        $this->redirect('/payment');
    }
}
?>
