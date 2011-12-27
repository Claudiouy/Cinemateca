<?php
class Performance extends AppModel{
    
var $name = 'Performance';
var $belongsTo  = array('Pelicula','Sala');

var $validate = array(
     'Buscar' => array(
     'rule' => 'notEmpty',
     'required' => false,
     'message' => 'Favor ingresar un dato',
     'last' => true),
    'precio' => array(
'rule' => array('money', 'left'),
'message' => 'Favor, ingrese el monto.'
));

}
?>