<?php
class SociosController extends AppController {

var $name =  'Socios';
var $helpers = array('Html', 'Form');

public function index(){
   
$active = $this->Socio->find('all');   
$this->set('onlyActive', $this->paginate('Socio', array ('Socio.estado'=>1)));
}


function view($id = null) {
    

        $this->Socio->id = $id;
        $this->set('socio', $this->Socio->read());
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
		$this->data['Socio']['image_url'] = $fileOK['urls'][0];
			}	
                    
if ($this->Socio->save($this->data)) {
			$this->Session->setFlash(__('El socio ha sido guardado', true));
			$this->redirect(array('action' => 'index'));
			} else {
			$this->Session->setFlash(__('El socio no ha podido ser guardado. Intente de nuevo.', true));
			}
		}
if (empty($this->data)) {
		$this->data = $this->Socio->read(null, $id);
		}
	}


        
function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID de Socio No Valido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Socio->saveField('estado', 'False')) {
                    
			$this->Session->setFlash(__('Socio dado de Baja', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El socio no ha podido ser dado de Baja', true));
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

// if file was uploaded ok  

if (!empty($this->data)) {

                $fileOK = $this->uploadFiles('img/files', $this->data['File']);
                
                if(array_key_exists('urls', $fileOK)) {
				// save the url in the form data
				$this->data['Socio']['image_url'] = $fileOK['urls'][0];
			}
		if ($this->Socio->save($this->data)) {
			$this->Session->setFlash('El socio ha sido guardado', 'flash_success');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('Socio no guardado. Intenta de nuevo.');
		}
	}}
        

 
function download($id = null) { 
        // Include Component 
        App::import('Component', 'Pdf'); 
        // Make instance 
        $Pdf = new PdfComponent(); 
        // Invoice name (output name) 
        $Pdf->filename = 'your_invoice'; // Without .pdf 
        // You can use download or browser here 
        $Pdf->output = 'download'; 
        $Pdf->init(); 
        // Render the view 
        $Pdf->process(Router::url('/', true) . 'socios/view/'. $id); 
        $this->render(false); 
    }         
        
}


?>