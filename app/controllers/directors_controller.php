<?php
class DirectorsController extends AppController {
	
	
var $name =  'Directors';
var $helpers = array('Html', 'Form');

public function index(){

$this->set('directors', $this->Director->find('all'));

}

function add(){
$this->loadModel('State'); 
$listado = $this->State->find('list', array('order' => 'State.name ASC'));
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


}
?>