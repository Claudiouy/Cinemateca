<?php
class  UsersController extends AppController{

var $name =  'Users';
var $helpers = array('Html', 'Form');

function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','index','logout');
    
        if($this->action == 'add'|| $this->action == 'edit'){
        $this->Auth->authenticate=$this->User;
        }
        
    }
    
function login() {
}

function logout() {
    	$this->Session->destroy(); 
	$this->redirect($this->Auth->logout());

	}

        function index() 
	{
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());

	    if ($this->Auth->user('roles') != 'admin') 
		{
			$this->Session->setFlash(__('Usuario No Valido', true));
			$this->redirect(array("controller" => "pages", "action" => "home"));
		}
	}
   

      function inicio(){
        
    }

    function view($id = null) {
        if(!$id){
        $this->Session->setFlash(__('Usuario no valido',true));
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
				$this->Session->setFlash(__('El usuario ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('El usuario no ha sido guardado, intentelo otra vez.', true));
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
$this->Session->setFlash('El Usuario ha sido salvado');
$this->redirect(array('action'=>'index'), null, true);
} else {
$this->Session->setFlash('El usuario no ha sido guardado, intentelo otra vez');
}
}
}

 function delete($id = null) {
if (!$id) {
$this->Session->setFlash('id Invalido de Usuario');
$this->redirect(array('action'=>'index'), null, true);
}
if ($this->User->delete($id)) {
	
$this->Session->setFlash('Usuario N° de '.$id.' Fue Borrado');
$this->redirect(array('action'=>'index'), null, true);
}
}   

}

?>
