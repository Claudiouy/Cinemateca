<?php
class PerformancesController extends AppController {

var $name =  'Performances';
var $helpers = array('Html','Form');
var $components = array('RequestHandler');

public function index(){

$this->paginate = array (
            'order' => array ('Performance.id' => 'DESC'),
            'limit'=> 5,
            //'fields' => array('id','sala_id','fecha','hora_comienzo','pelicula_id','estreno'), //array of field names
            'conditions' => array ('Performance.estado'=>1,
));
$onlyActive = $this->paginate('Performance');
$this->set(compact('onlyActive'));
 }
function add(){
$this->loadModel('Sala'); 
$list_salas = $this->Sala->find('list', array('order' => 'Sala.name ASC'));
$this->set('list_salas', $list_salas);
$this->loadModel('Pelicula'); 
$list_pelis = $this->Pelicula->find('list', array('order' => 'Pelicula.name ASC'));
$this->set('list_pelis', $list_pelis);

//var_dump($listado);
	if (!empty($this->data)) {
		if ($this->Performance->saveAll($this->data)) {
			$this->Session->setFlash('La nueva funcion ha sido guardada', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('La funcion No se ha guardado. Intenta de nuevo.', 'flashmsg/flash_warning');
		}
	}

}
function view($id = null) {
   $activa = $this->Performance->findById($id, array( 
        'fields' =>'Performance.estado',
        'recursive' => 0));
    
   
   $valor = $activa['Performance']['estado'];
   
    if ($valor ==0) {
        $this->Session->setFlash('.::. FUNCION   DADA   DE   BAJA .::.', 'flashmsg/flash_warning');
    }
    
   $estreno = $this->Performance->findById($id, array( 
        'fields' =>'Performance.estreno',
        'recursive' => 0));
    
   
   $valor = $estreno['Performance']['estreno'];
   
    if ($valor ==1 && $activa==1) {
        $this->Session->setFlash('.::. E S T R E N O  .::.', 'flashmsg/flash_info');
    }
    
    $this->Performance->id = $id;
    $this->set('performance', $this->Performance->read());
	}
        
function edit($id = null) {
$this->loadModel('Sala'); 
$list_salas = $this->Sala->find('list', array('order' => 'Sala.name ASC'));
$this->set('list_salas', $list_salas);

$this->loadModel('Pelicula'); 
$list_pelis = $this->Pelicula->find('list', array('order' => 'Pelicula.name ASC'));
$this->set('list_pelis', $list_pelis);


if (!$id && empty($this->data)) {
			$this->Session->setFlash('Funcion Invalida','flashmsg/flash_bad');
			$this->redirect(array('action' => 'index'));
		}
if (!empty($this->data)) {

 if ($this->Performance->saveAll($this->data)){
			$this->Session->setFlash('La funcion ha sido Actualizada', 'flashmsg/flash_good');
			$this->redirect(array('action' => 'view/'.$id));
			} else {
			$this->Session->setFlash('La funcion No ha podido ser guardada. Intente de nuevo.', 'flashmsg/flash_bad');
                    }
		}
if (empty($this->data)) {
		$this->data = $this->Performance->read(null, $id);
		}
	}
        
function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Funcion No Valida', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Performance->saveField('estado', 0)) {

                    
			$this->Session->setFlash('Funcion N° '.$id.' ha sido dada de Baja', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('La funcion no ha podido ser dada de Baja', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}
function activar($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Funcion No Valida', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Performance->saveField('estado', 1)) {
			$this->Session->setFlash('La funcion N° '.$id.' ha sido dada de Alta Nuevamente', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'view/'.$id));
		}
		$this->Session->setFlash('La funcion no ha podido ser dada de Alta', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}      
function search(){


$cond = 'Performance.estado = 0'; 

$this->paginate = array (
            'order' => array ('Performance.id' => 'DESC'),
            'limit'=> 10,
            'fields'=>array('id','sala_id','fecha','hora_comienzo','pelicula_id','estreno','estado'),
            'conditions' => $cond,
            'recursive' => 2   );
$performances = $this->paginate('Performance');
$this->set(compact('performances'));
}        
}
?>
