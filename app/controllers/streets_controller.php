<?php
class StreetsController extends AppController {
var $name =  'Streets';
var $helpers = array('Html', 'Form');

var $paginate = array(
        'fields' => array('Street.id', 'Street.name'),
        'limit' => 105,        
        'order' => array(
            'Street.name' => 'asc'
        )
    );


public function index(){

//$this->set('directors', $this->Director->find('all'));

$misstreets = $this->Street->find('all', array('limit' => 100));   
$this->set('misstreets', $this->paginate('Street'));

}

}
?>