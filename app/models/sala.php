<?php
class Sala extends AppModel {
var $name = 'Sala';
public $hasMany = array('Performance');
}
?>