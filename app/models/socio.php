<?php
class Socio extends AppModel {
var $name = 'Socio';
var $hasMany = array('Payment');


var $belongsTo = array('Street','State','Subscription','PaymentMethod');


}
?>