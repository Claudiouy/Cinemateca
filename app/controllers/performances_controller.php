<?php
class PerformancesController extends AppController {

var $name =  'Performances';
var $helpers = array('Html','Form');
var $components = array('RequestHandler');

public function index(){

   
$this->paginate = array (
            'order' => array ('Performance.id' => 'DESC'),
            'limit'=> 5,
            //'fields' => array('Performance.id','Socio.name','Sala.name','Socio.documento_identidad'), //array of field names
            'conditions' => array ('Performance.estado'=>1),
            'recursive' => 0);
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
   $estreno = $this->Performance->findById($id, array( 
        'fields' =>'Performance.estreno',
        'recursive' => 0));
    
   
   $valor = $estreno['Performance']['estreno'];
   
    if ($valor ==1) {
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
        
        
}
?>
