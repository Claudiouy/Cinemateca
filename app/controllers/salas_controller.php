<?php
class SalasController extends AppController {
var $name =  'Salas';


function beforeFilter(){
        
        parent::beforeFilter();
        $this->Auth->allow('logout');
        
        if($this->action == 'index'|| $this->action == 'edit' || $this->action == 'add'){
            if($this->viewVars['admin'] == false){
                $this->Session->setFlash('Solo usuarios administrativos pueden ingresar a Sala');
                $this->redirect('/');

            }
        }
       
    }

    function write_global_sala_id(){
        
        if(!empty($_POST['idSala'])){
            $idGlobalSala = $_POST['idSala'];
            $this->Session->write("SalaId", $idGlobalSala);
            $this->autoRender=false;
            return 'true';
        }
        return 'false';
    }
    
function index() {
    
$this->paginate = array (
            'order' => array ('Sala.id' => 'DESC'),
            'limit'=> 5,
            'conditions' => array ('Sala.estado'=>1),
            'recursive' => -1);
$onlyActive = $this->paginate('Sala');
$this->set(compact('onlyActive'));

}
function delete($id = null) {
if (!$id) {
$this->Session->setFlash('Id. invalido para Sala');
$this->redirect(array('action'=>'index'), null, true);
}
if ($this->Sala->saveField('estado', 0)) {

                    
			$this->Session->setFlash('Sala N° '.$id.' ha sido dada de Baja', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'));
		}
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
        
function add(){

		
	if (!empty($this->data)) {
		$this->Sala->create();
		if ($this->Sala->save($this->data)) {
			$this->Session->setFlash('La Sala ha sido dada de Alta', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('La sala no se ha guardado. Intenta de nuevo.');
		}
	}

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

function search(){
//ini_set('memory_limit','128M');

$search = $this->data['Sala']['Buscar'];

$cond = 'Sala.name LIKE "%'.$search.'%"'; 

$this->paginate = array (
            'order' => array ('Sala.id' => 'DESC'),
            'limit'=> 5,
            'fields'=>array('Sala.id','Sala.name','Sala.capacidad','Sala.estado'),
            'conditions' => $cond,
            'recursive' => -1   );
$salas = $this->paginate('Sala');
$this->set(compact('salas'));
}


        
        
        
}
?>