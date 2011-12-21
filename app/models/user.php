<?php
class User extends AppModel {
	
var $name = 'User';

var $displayField = 'username';

var $validate = array(
		'username' => array(
			'between' => array(
			'rule' => array('between', 5, 15),
                        'message'=>'El nombre de usuario debe contener entre 5 y 15 caracteres.',
			'last' => true),
			'characters' => array(
                        'rule' => array('custom', '/^[a-zA-Z0-9]*$/i'),
			'last' => true),
			'isUnique' => 'isUnique',
                        'message'=>'Ese nombre de usuario ya esta en uso.',
                        'last' => true),
		

		'password'=>array(
			'La clave de usuario debe contener entre 5 y 15 caracteres.'=>array(
			'rule'=>array('between', 5, 15),
			'message'=>'La clave de usuario debe contener entre 5 y 15 caracteres.'	),
			'Las claves no son iguales'=>array(
			'rule'=>'matchPasswords',
			'message'=>'Las claves no son iguales.')
                                )
                    );
	


function matchPasswords($data)	{
    
		if($data['password'] == $this->data['User']['password_confirmation'])
		{
			return TRUE;
		}
		$this->invalidate('password_confirmation', 'Las claves no son iguales.');
		return FALSE;
	}




function hashPasswords($data)
	{
		if(isset($this->data['User']['password']))
		{
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);
			return $data;
		}
		return $data;
	}

    function beforeSave($options = array()) {
        $this->hashPasswords(NULL,TRUE);
        return TRUE;
    }
    
    

    
}
?>