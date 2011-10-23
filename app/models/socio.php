<?php
class Socio extends AppModel {
var $name = 'Socio';

var $belongsTo = array('Street','State','Subscription','PaymentMethod');

}
?>