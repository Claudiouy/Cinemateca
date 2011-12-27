<?php
class User extends AppModel {
	
var $name = 'User';

var $displayField = 'username';

var $validate = array(
		 'username' => array(
                                
                 'rule' => 'isUnique',
                 'message' => 'Usuario Existente.'),
    
                   
		

		'password'=>array(
			'La clave de usuario debe contener entre 5 y 15 caracteres.'=>array(
			'rule'=>array('between', 5, 15),
			'message'=>'La clave de usuario debe contener entre 5 y 15 caracteres.'	),
			'Las claves no son iguales'=>array(
			'rule'=>'matchPasswords',
			'message'=>'No coiciden.')
                                )
                    );
	


function matchPasswords($data)	{
    
		if($data['password'] == $this->data['User']['password_confirmation'])
		{
			return TRUE;
		}
		$this->invalidate('password_confirmation', 'No coiciden.');
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