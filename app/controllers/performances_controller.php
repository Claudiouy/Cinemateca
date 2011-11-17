<?php
class PerformancesController extends AppController {

var $name =  'Performances';
var $helpers = array('Html','Form','DatePicker');
var $components = array('RequestHandler');

public function index(){
$active = $this->Performance->find('all');   
$this->set('onlyActive', $this->paginate('Performance', array ('Performance.estado'=>'Activa')));


    

}

function view($id = null) {
    

        $this->Performance->id = $id;
        $this->set('performance', $this->Performance->read());
	}
}
?>
