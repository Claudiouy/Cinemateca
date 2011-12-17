<?php
class SociosController extends AppController {

var $name =  'Socios';
var $components = array('RequestHandler');
var $helpers = array('Html','Form');

public function index(){
   
$this->paginate = array (
            'order' => array ('Socio.id' => 'DESC'),
            'limit'=> 5,
            'fields'=>array('Socio.id','Socio.name','Socio.surname','Socio.documento_identidad','PaymentMethod.name','Suscription.name'),
            'conditions' => array ('Socio.estado'=>1),
            'recursive' => 0);
$onlyActive = $this->paginate('Socio');
//pr($onlyActive);
$this->set(compact('onlyActive'));

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


$this->loadModel('Creditcard'); 
$list_cc = $this->Creditcard->find('list', array('order' => 'Creditcard.id ASC'));
$this->set('list_cc', $list_cc);

/*
aca hay que agregar a los socios colectivos. * 
 */
//$list_colectivos = $this->Socio->find('list', array('fields' => array('Socio.', 'User.first_name', 'User.group'));

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
			$this->Session->setFlash('Socio No Guardado. Revise los campos obligatorios si contienen errores.', 'flashmsg/flash_bad');
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
$list_cc = $this->Creditcard->find('list', array('order' => 'Creditcard.id ASC'));
$this->set('list_cc', $list_cc);


// if file was uploaded ok  

if (!empty($this->data)) {
    
                $fileOK = $this->uploadFiles('img/files', $this->data['File']);
       
                if(array_key_exists('urls', $fileOK)) {
				// save the url in the form data
		$this->data['Socio']['image_url'] = $fileOK['urls'][0];
		
                }
		if ($this->Socio->saveAll($this->data['Socio'])) {
$this->Socio->generaDeuda($this->data['Socio']['suscription_id']);	
$misocio= $this->Socio->getSocioByDocument($this->data['Socio']['documento_identidad']);    
$id=$misocio['Socio']['id'];
   $this->Session->setFlash('El socio ha sido dado de alta Ingrese el pago', 'flashmsg/flash_good');

                    $this->redirect(array('controller'=>'payments','action'=>'retrieveSocioById/'.$id), null, true);
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
function view($id = null){    
    
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
 Configure::write('debug',0);
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
 Configure::write('debug',0);
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
 
$cantidad =  $this->Socio->find('count', array('conditions' => array('Socio.colectivo' => 1)));

if($cantidad > 1){
     
$this->loadModel('Colectivo'); 
$this->Colectivo->save();

$last_colectivo = $this->Colectivo->find('first',array('order' => array('Colectivo.created DESC'),
                                              array('recursive' => -1)));
$last= $last_colectivo ['Colectivo']['id'];  

            if(!empty($_POST['idSelec'])){
                //echo "cantidad de ids".count($_POST);
                $ids = $_POST['idSelec'];
                $idsStr = explode(',', $ids);
                               $cant = count($idsStr);

                if($cant>1 ){
                   $ids = implode('","', $idsStr);
                $condiciones = 'Socio.id IN ("' .$ids .'")';
                if($this->Socio->updateAll(array('Socio.colectivo' => $last), $condiciones)){
                $this->Session->setFlash('Se realizó el colectivo con Exito', '/flashmsg/flash_good');
		$this->redirect(array('action' => 'index'));
                    
                }
                else {
$this->Session->setFlash('No fue posible armar dicho colectivo.', '/flashmsg/flash_bad');
                    			$this->redirect(array('action' => 'index'));

                } 
                }  else {
           $this->Session->setFlash('Los colectivos deben contener al menos 2 Socios.', '/flashmsg/flash_warning');
         			$this->redirect(array('action' => 'index'));

                }
                
                ; 
            }
            $this->Session->setFlash('Para armar el colectivo, debe agrupar a los socios .', '/flashmsg/flash_info');
                    			$this->redirect(array('action' => 'index'));


}else{
$this->Session->setFlash('Para Asociaciones Colectivas: Deben de haber un MINIMO de 2 SOCIOS COLECTIVOS para agrupar.
   Al momento hay : '.$cantidad, 'flashmsg/flash_warning');
$this->redirect(array('action' => 'index'));
}    
 

}
function colectivos (){
$cantidad =  $this->Socio->find('count', array('conditions' => array('Socio.colectivo' => 1)));

if($cantidad > 1){  
    $this->paginate = array (
            'order' => array ('Socio.id' => 'DESC'),
            'limit'=> 10,
         'recursive'=>-1,   
        'fields' => array('Socio.id','Socio.name','Socio.surname','Socio.documento_identidad','Socio.estado' ,'Socio.image_url'), //array of field names
            'conditions' => array ('Socio.colectivo'=>1));

$onlyColectivos = $this->paginate('Socio');
$this->set(compact('onlyColectivos'));

}  else {
$this->redirect(array('action' => 'index'));
}
}
function search(){

$search = $this->data['Socio']['Buscar'];

$cond = 'Socio.name LIKE "%'.$search.'%" OR '. 'Socio.surname LIKE "%'.$search.'%" OR '.
        'Socio.documento_identidad LIKE "%'.$search.'%" OR '. 'Socio.ocupacion LIKE "%'.$search.'%" OR '.
        'Socio.tel_fijo LIKE "%'.$search.'%" OR '. 'Socio.estado LIKE "%'.$search.'%" OR '.
        'Socio.celular LIKE "%'.$search.'%" OR '. 'Socio.email LIKE "%'.$search.'%" OR '.
        'Socio.calle_princ LIKE "%'.$search.'%" OR '. 'Socio.calle_cobro LIKE "%'.$search.'%"';

$this->paginate = array (
            'order' => array ('Socio.id' => 'DESC'),
            'limit'=> 5,
            'fields'=>array('Socio.id','Socio.name','Socio.surname','Socio.estado','Socio.documento_identidad','Socio.ocupacion'),
            'conditions' => $cond,
            'recursive' => -1   );
$socios = $this->paginate('Socio');
$this->set(compact('socios'));
}




}?>