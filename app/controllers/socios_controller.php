<?php
class SociosController extends AppController {
var $name =  'Socios';
var $helpers = array('Html', 'Form');

public function index(){
   
$active = $this->Socio->find('all');   
$this->set('onlyActive', $this->paginate('Socio', array ('Socio.estado'=>1)));
}


function view($id = null) {
    

        $this->Socio->id = $id;
        $this->set('socio', $this->Socio->read());
	}


function edit($id = null) {

$this->loadModel('State'); 
$list_state = $this->State->find('list', array('order' => 'State.id ASC'));
$this->set('list_state', $list_state);

$this->loadModel('Subscription'); 
$list_suscription = $this->Subscription->find('list', array('order' => 'Subscription.id ASC'));
$this->set('list_suscription', $list_suscription);


$this->loadModel('Payment_method'); 
$list_pay_method = $this->Payment_method->find('list', array('order' => 'Payment_method.id ASC'));
$this->set('list_pay_method', $list_pay_method);



          
            if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Socio Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Socio->save($this->data)) {
				$this->Session->setFlash(__('El socio ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El socio no ha podido ser guardado. Intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Socio->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID de Socio No Valido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Socio->saveField('estado', 'False')) {
                    
			$this->Session->setFlash(__('Socio dado de Baja', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El socio no ha podido ser dado de Baja', true));
		$this->redirect(array('action' => 'index'));
	}

function add(){

    
    
$this->loadModel('State'); 
$list_state = $this->State->find('list', array('order' => 'State.id ASC'));
$this->set('list_state', $list_state);

$this->loadModel('Subscription'); 
$list_suscription = $this->Subscription->find('list', array('order' => 'Subscription.id ASC'));
$this->set('list_suscription', $list_suscription);


$this->loadModel('Payment_method'); 
$list_pay_method = $this->Payment_method->find('list', array('order' => 'Payment_method.id ASC'));
$this->set('list_pay_method', $list_pay_method);


/*$this->loadModel('Street'); 
$list_street = $this->Street->find('list', 5,array('order' => 'Street.id ASC'));
$this->set('list_street', $list_street);*/

	if (!empty($this->data)) {
		
		$this->Socio->create();
		if ($this->Socio->save($this->data)) {
			$this->Session->setFlash('El Socio ha sido guardado', 'flash_success');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('Socio no guardado. Intenta de nuevo.');
		}
	}

}
        
        
}
?>