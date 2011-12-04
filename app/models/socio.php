<?php
class Socio extends AppModel {
var $name = 'Socio';
var $hasMany = array('Payment');
var $belongsTo = array('State','Suscription','PaymentMethod');


  var $validate = array(
     'name' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un nombre'),
     
     'surname' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un apellido'),
    
     'fec_nac' => array(
     'rule' => 'date',
     'message' => 'Favor ingrese una fecha de nacimiento'),
        
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
     'message' => 'Favor ingresar un email valido'),
    
    'documento_identidad' => array(
     'noVacio' => array(
     'rule' => 'notEmpty',  
     'message' => 'Se debe ingresar un documento de identidad',
     'last' => true),
       
     'soloNumeros' => array(
     'rule' => 'numeric',  
     'message' => 'Debe ser solo numeros sin puntos ni guiones',
     'last' => true),
        
     'esUnico' => array(
     'rule' => 'isUnique',  
     'message' => 'Ese documentos ya ha sido ingresado, consulte al Administrador',
     'last' => true
        )  
    )
    

        );
    
  
  
    function getSocioByDocument($docSocio){
        
        if(!empty($docSocio)){
            $mySocio = $this->find('first', array('conditions' => array('Socio.documento_identidad' => $docSocio)));
        }
        return $mySocio;
    }
  
}
?>