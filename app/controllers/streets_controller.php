<?php
class StreetsController extends AppController {
var $name =  'Streets';
var $helpers = array('Html', 'Form');

public function index(){

$this->set('streets', $this->Street->find('all'));
}



}
?>