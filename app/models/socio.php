<?php
class Socio extends AppModel {
var $name = 'Socio';
var $belongsTo = array('Street');
var $hasMany = array('Payment');


}
?>