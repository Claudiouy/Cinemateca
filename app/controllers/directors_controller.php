<?php
class DirectorsController extends AppController {
	
	
var $name =  'Directors';
var $helpers = array('Html', 'Form');
//var $uses = array('state','director' );

public function index(){

$this->set('directors', $this->Director->find('all'));
//$states=$this->Director->State->find('list');
//var_dump($states);

}

function add(){
	$this->loadModel('State'); 
	
	#$listado = ClassRegistry::init("State")->find("all");
	#App::import('State', 'State');
	#$listado = $this->State->find('all');
		#var_dump($listado);
		
$listado = $this->State->find('list', array('order' => 'State.name ASC'));
		
		//$listado = $this->State->find('all');
		$this->set('listado', $listado);
		//var_dump($listado);
	if (!empty($this->data)) {
		
		$this->Director->create();
		if ($this->Director->save($this->data)) {
			$this->Session->setFlash('El director ha sido guardado', 'flash_success');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('Director no guardado. Intenta de nuevo.');
		}
	}

}

function edit($id = null) {
$this->loadModel('State'); 
$listado = $this->State->find('list', array('order' => 'State.id ASC'));
$this->set('listado', $listado);

    if (!$id) {
$this->Session->setFlash('Director No Válida');
$this->redirect(array('action'=>'index'), null, true);
}
if (empty($this->data)) {
$this->data = $this->Director->find(array('Director.id' => $id));
} else {
if ($this->Director->save($this->data)) {
$this->Session->setFlash('El Director ha sido salvado');
$this->redirect(array('action'=>'index'), null, true);
} else {
$this->Session->setFlash('El Director no ha podido ser salvado.
Inténtalo de nuevo.');
}
}
}


function delete($id = null) {
if (!$id) {
$this->Session->setFlash('id Invalida para Director');
$this->redirect(array('action'=>'index'), null, true);
}
if ($this->Director->delete($id)) {
	
$this->Session->setFlash('Director #'.$id.' borrado');
$this->redirect(array('action'=>'index'), null, true);
}
}

}
?>