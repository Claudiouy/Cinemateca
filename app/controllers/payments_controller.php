<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class PaymentsController extends AppController{
    var $name = 'Payments';
    
  //  var $components = array('RequestHandler');  // para no mostrar header y footer cuando cargo un element
    
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
            $this->set('selSocio', $selSocio);
            //var_dump($selSocio);
            //echo $selSocio["Socio"]["apellido"];
        }
        $this->render('/payments/new_payment');
        //$this->render($selSocio['Socio']['apellido']);
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
    
}
?>
