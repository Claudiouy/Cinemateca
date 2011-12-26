<?php
class StreetsController extends AppController {
var $name =  'Streets';

var $helpers = array('Html', 'Form');

public function index(){
      
$this->paginate = array (
            'order' => array ('Street.id' => 'DESC'),
            'limit'=> 10,
            'recursive' => 0);
$streets = $this->paginate('Street');
$this->set(compact('streets'));
}
}
?>