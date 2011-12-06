<?php
class SociosController extends AppController {

var $name =  'Socios';
var $components = array('RequestHandler');
var $helpers = array('Html','Form');

public function index(){
   
$this->paginate = array (
            'order' => array ('Socio.id' => 'DESC'),
            'limit'=> 5,
            //'fields' => array('list'), //array of field names
            'conditions' => array ('Socio.estado'=>1),
            'recursive' => 0);
$onlyActive = $this->paginate('Socio');
$this->set(compact('onlyActive'));
/*
    
    $this->Socio->recursive = ;
        $conditions = array('Socio.estado = ' => 0);
        $this->set('onlyActive', $this->paginate('Socio', $conditions));
*/   
}

function edit($id = null) {

$this->loadModel('State'); 
$list_state = $this->State->find('list', array('order' => 'State.id ASC'));
$this->set('list_state', $list_state);

$this->loadModel('Suscription'); 
$list_suscription = $this->Suscription->find('list', array('order' => 'Suscription.id ASC'));
$this->set('list_suscription', $list_suscription);


$this->loadModel('Payment_method'); 
$list_pay_method = $this->Payment_method->find('list', array('order' => 'Payment_method.id ASC'));
$this->set('list_pay_method', $list_pay_method);


if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Socio Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
if (!empty($this->data)) {
		$fileOK = $this->uploadFiles('img/files', $this->data['File']);
                
if(array_key_exists('urls', $fileOK)) {
// save the url in the form data
$this->data['Socio']['image_url'] = $fileOK['urls'][0];}
//var_dump($data['Socio']['fec_nac']);
if ($this->Socio->saveAll($this->data)){
			$this->Session->setFlash('El socio ha sido guardado', 'flashmsg/flash_good');
			$this->redirect(array('action' => 'view/'.$id));
			} else {
			$this->Session->setFlash('El socio no ha podido ser guardado. Intente de nuevo.', 'flashmsg/flash_bad');
                    }
		}
if (empty($this->data)) {
		$this->data = $this->Socio->read(null, $id);
		}
	}
        
function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Socio No Valido', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Socio->saveField('estado', 0)) {

                    
			$this->Session->setFlash('Socio N° '.$id.' ha sido dado de Baja', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('El socio no ha podido ser dado de Baja', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}

function add(){
  
$this->loadModel('State'); 
$list_state = $this->State->find('list', array('order' => 'State.id ASC'));
$this->set('list_state', $list_state);

$this->loadModel('Suscription'); 
$list_suscription = $this->Suscription->find('list', array('order' => 'Suscription.id ASC'));
$this->set('list_suscription', $list_suscription);


$this->loadModel('Payment_method'); 
$list_pay_method = $this->Payment_method->find('list', array('order' => 'Payment_method.id ASC'));
$this->set('list_pay_method', $list_pay_method);

$this->loadModel('Creditcard'); 
$list_cc = $this->Creditcard->find('list', array('order' => 'Creditcard.name ASC'));
$this->set('list_cc', $list_cc);


// if file was uploaded ok  

if (!empty($this->data)) {

                $fileOK = $this->uploadFiles('img/files', $this->data['File']);
                
                if(array_key_exists('urls', $fileOK)) {
				// save the url in the form data
				$this->data['Socio']['image_url'] = $fileOK['urls'][0];
			}
		if ($this->Socio->save($this->data)) {
			$this->Session->setFlash('El socio ha sido guardado', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('Socio no guardado. Intenta de nuevo.','flashmsg/flash_warning');
		}
	}
        }

        

   function getcalles(){
    
    $this->loadModel('Street'); 

		if ( $this->RequestHandler->isAjax() ) {
   			Configure::write ('debug', 0);
   			$this->autoRender=false;
			 
                        
                        $streets=$this->Street->find('all',array('limit'=> 5,'conditions'=>array('Street.name LIKE'=>'%'.$_GET['term'].'%')));
				$i=0;
				foreach($streets as $street){
					$response[$i]['value']=$street['Street']['name'];
$i++;
                                        }
			echo json_encode($response);
		}else{
			if (!empty($this->data)) {
			$this->set('streets',$this->paginate(array('Street.name LIKE'=>'%'.$this->data['Street']['name'].'%')));
			

                        }
		}
	}
        
function getnations(){
    
    $this->loadModel('State'); 

		if ( $this->RequestHandler->isAjax() ) {
   			Configure::write ('debug', 0);
   			$this->autoRender=false;
			 
                        
                        $states=$this->State->find('all',array('conditions'=>array('State.name LIKE'=>'%'.$_GET['term'].'%')));
				$i=0;
				foreach($states as $state){
					$response[$i]['value']=$state['State']['name'];
$i++;
                                        }
			echo json_encode($response);
		}else{
			if (!empty($this->data)) {
			$this->set('streets',$this->paginate(array('State.name LIKE'=>'%'.$this->data['State']['name'].'%')));
			

                        }
		}
	}
        
        
function view($id = null)
{    
    
    $activo = $this->Socio->findById($id, array( 
        'fields' =>'Socio.estado',
        'recursive' => 0));
    
   
   $valor = $activo['Socio']['estado'];
   
    if ($valor ==0) {
        $this->Session->setFlash('.::. SOCIO   DADO   DE   BAJA .::.', 'flashmsg/flash_warning');
    }
    if(!$id){
        $this->Session->setFlash('Socio no valido','flashmsg/flash_bad');
        $this->redirect(array('action'=>'index'));
        }
                
        $this->set('socio', $this->Socio->read(null, $id));
    }
        
function activar($id = null) {
		if (!$id) {
			$this->Session->setFlash('ID de Socio No Valido', 'flashmsg/flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Socio->saveField('estado', 1)) {
			$this->Session->setFlash('El socio N° '.$id.' ha sido dado de Alta Nuevamente', 'flashmsg/flash_good');
			$this->redirect(array('action'=>'view/'.$id));
		}
		$this->Session->setFlash('El socio no ha podido ser dado de Alta', 'flashmsg/flash_warning');
		$this->redirect(array('action' => 'index'));
	}
     
function contrato($id = null) {
 Configure::write('debug',3);
    $estado = $this->Socio->findById($id, array( 
        'fields' =>'Socio.estado',
        'recursive' => 0    ));
    $valor = $estado['Socio']['estado'];
   
    if ($valor ==0) {
        $this->Session->setFlash('Atencion: Este socio esta dado de baja','flashmsg/flash_info');
    }
    
        $this->Socio->id = $id;
        $this->set('socio', $this->Socio->read());
$this->layout = 'pdf'; //esto usara el layout pdf.ctp
        $this->render();
        
        
        }

function detalle_completo($id = null) {
 Configure::write('debug',3);
    $estado = $this->Socio->findById($id, array( 
        'fields' =>'Socio.estado',
        'recursive' => 0    ));
    $valor = $estado['Socio']['estado'];
   
    if ($valor ==0) {
        $this->Session->setFlash('Atencion: Este socio esta dado de baja','flashmsg/flash_info');
    }
    
        $this->Socio->id = $id;
        $this->set('socio', $this->Socio->read());
$this->layout = 'pdf'; //esto usara el layout pdf.ctp
        $this->render();
        
        
        }



 
function asoc_colectivos(){
      
$this->loadModel('Colectivo'); 
$this->Colectivo->save();

$last_colectivo = $this->Colectivo->find('first',array('order' => array('Colectivo.created DESC'),
                                              array('recursive' => 0)));
$last= $last_colectivo ['Colectivo']['id'];  

            if(!empty($_POST['idSelec'])){
                $ids = $_POST['idSelec'];
                $idsStr = explode(',', $ids);
                $ids = implode('","', $idsStr);
                $condiciones = 'Socio.id IN ("' .$ids .'")';
                if($this->Socio->updateAll(array('Socio.colectivo' => $last), $condiciones)){
                $this->Session->setFlash(__('Se realizó el colectivo con Exito', 'flash_good'));
			$this->redirect(array('action' => 'index'));
                    
                }
                else {
$this->Session->setFlash(__('No fue posible armar dicho colectivo.', 'flash_bad'));
                    
                }
                ; 
            }
}
function colectivos (){

$cantidad =  $this->Socio->find('count', array('conditions' => array('Socio.colectivo' => 1)));
    //echo $cantidad;

if($cantidad > 1){
  //  echo $cantidad;

    $this->paginate = array (
            'order' => array ('Socio.id' => 'DESC'),
            'limit'=> 6,
            'fields' => array('Socio.id','Socio.name','Socio.surname','Socio.documento_identidad','Socio.estado'), //array of field names
            'conditions' => array ('Socio.colectivo'=>1));


$onlyColectivos = $this->paginate('Socio');
$this->set(compact('onlyColectivos'));
}else{
$this->Session->setFlash('Para Asociaciones Colectivas: Deben de haber un MINIMO de 2 SOCIOS COLECTIVOS para agrupar', 'flashmsg/flash_warning');
$this->redirect(array('action' => 'index'));
}}

function creditcards (){
$this->layout = 'ajax';
$this->loadModel('Creditcard'); 
$list_cc = $this->Creditcard->find('list', array('order' => 'Creditcard.name ASC'));
$this->set('list_cc', $list_cc);
//var_dump($list_cc);
}

}?>