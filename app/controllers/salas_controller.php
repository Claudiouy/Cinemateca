<?php
class SalasController extends AppController {
var $name =  'Salas';

function index() {
    
$this->paginate = array (
            'order' => array ('Sala.id' => 'DESC'),
            'limit'=> 5,
            'conditions' => array ('Sala.estado'=>1),
            'recursive' => -1);
$onlyActive = $this->paginate('Sala');
$this->set(compact('onlyActive'));

}


function activar($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Sala No Valida', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sala->saveField('estado', 1)) {
			$this->Session->setFlash('La Sala N° '.$id.' ha sido dada de Alta Nuevamente', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'view/'.$id));
		}
		$this->Session->setFlash('La sala no ha podido ser dada de Alta', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}

function view($id = null) {
 
        
    $this->Sala->id = $id;
    $this->set('sala', $this->Sala->read());
	}        
        


function edit($id = null) {
	$this->Sala->id = $id;
	if (empty($this->data)) {
		$this->data = $this->Sala->read();
	} else {
		if ($this->Sala->save($this->data)) {
			$this->Session->setFlash('Se actualizo la sala.', 'flashmsg/flash_good');
			$this->redirect(array('action' => 'index'));
		}
	}
}


        
function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Sala No Valido', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sala->saveField('estado', 0)) {

                    
			$this->Session->setFlash('Sala N° '.$id.' ha sido dado de Baja', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('El sala no ha podido ser dada de Baja', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}        
        
}
?>