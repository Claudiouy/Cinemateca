<?php
class Socio extends AppModel {
var $name = 'Socio';
var $hasMany = array('Payment');


var $belongsTo = array('Street','State','Subscription','PaymentMethod');

var $validate = array(
     'name' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un nombre'),
     'surname' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un apellido'),
     'documento_identidad' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un documento'),
     
     'documento_identidad' => array(
     'rule' => 'numeric',
     'message' => 'Favor ingresar el documento sin puntos ni guiones'),
     
    'documento_identidad' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar el documento sin puntos ni guiones'),
     
    
     'documento_identidad' => array(
     'rule' => 'isUnique',
     'message' => 'Ese N° de documento ya esta ingresado'),
     
     'tel_fijo' => array(
     'required' => true,    
     'rule' => 'numeric',
     'message' => 'Favor ingresar solo numeros'
     ),
     'celular' => array(
     'rule' => 'numeric',
     'required' => false,
     'message' => 'Favor ingresar solo numeros'
     ),
    'celular' => array(
     'rule' => 'notEmpty',
     'required' => false,
     'message' => 'Favor ingresar solo numeros'
     ),
     'email' => array(
     'required' => false,
     'rule' => 'email',
     'message' => 'Favor ingresar un email valido')
    
);
    
    function getSocioByDocument($docSocio){
        
        if(!empty($docSocio)){
            $mySocio = $this->find('first', array('conditions' => array('Socio.documento_identidad' => $docSocio)));
        }
        return $mySocio;
    }


}
?>