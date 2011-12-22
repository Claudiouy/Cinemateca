<?php
class  UsersController extends AppController{

var $name =  'Users';
var $helpers = array('Html', 'Form');

function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    
        if($this->action == 'add'|| $this->action == 'edit'){
        $this->Auth->authenticate=$this->User;
        }
        
    }
    
function login() {
 //ini_set('memory_limit', '32M');
  //echo phpinfo(); 

  
}

function logout() {
//    	$this->Session->destroy(); 
//	$this->redirect($this->Auth->logout());
//$this->Cookie->del('gate');
		$this->Session->setFlash('Sesion Finalizada.', '/flashmsg/flash_good');
		$this->redirect($this->Auth->logout());
	}

function index(){ 

   
$this->paginate = array (
            'order' => array ('User.id' => 'DESC'),
            'limit'=> 5,
            'conditions' => array ('User.estado'=>1),
            'recursive' => 0);
$onlyActive = $this->paginate('User');
$this->set(compact('onlyActive'));

	    if ($this->Auth->user('roles') != 'admin') 
		{
			//$this->Session->setFlash(__('Usuario No Valido', true));
			//$this->redirect(array("controller" => "pages", "action" => "home"));
		} 
                }
   

function inicio(){
        
    }

 function view($id = null) {
        if(!$id){
        $this->Session->setFlash('Usuario no Valido.', '/flashmsg/flash_bad');
        $this->redirect(array('action'=>'index'));
        }
                
        $this->set('user', $this->User->read(null, $id));
    }
        
    function add() {
  
	if (!empty($this->data)) 
		{
			$this->User->create();
			
			if ($this->User->save($this->data)) 
			{
				$this->Session->setFlash('El usuario ha sido dado de Alta.', '/flashmsg/flash_good');
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('El usuario no ha sido guardado, intentelo otra vez', '/flashmsg/flash_bad');
			}
		}
	}
                
 function edit($id = null) {
      if (!$id) {
$this->Session->setFlash('Usuario No Válido');
$this->redirect(array('action'=>'index'), null, true);
}
if (empty($this->data)) {
$this->data = $this->User->find(array('User.id' => $id));
} else {
if ($this->User->save($this->data)) {
$this->Session->setFlash('El Usuario ha sido salvado', '/flashmsg/flash_good');
$this->redirect(array('action'=>'index'), null, true);
} else {
$this->Session->setFlash('El usuario no ha sido guardado, intentelo otra vez', '/flashmsg/flash_warning');
}
}
}

 function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de usuario no valido', '/flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->saveField('estado', 'False')) {
                    
			$this->Session->setFlash('El usuario no ha sido desactivado.', '/flashmsg/flash_info');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('El usuario no ha podido darse de baja.', '/flashmsg/flash_info');
		$this->redirect(array('action' => 'index'));
	}

}

?>
