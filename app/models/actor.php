<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Actor extends AppModel{
    var $name = 'Actor';
    
    var $validate = array(
        'name' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'Nombre es un campo requerido'
             ),
        'lastname' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'El apellido es un campo requerido'
             ),
        'birthdate' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'La fecha de nacimento es un campo requerido'
             )       
    );
    
    
    public function getAllActors(){
        $actors = $this->find('all');
        return $actors;
    }
    
    public function getActorById($actorId){
        $myActor = $this->findById($actorId);
        return $myActor;
    }
    
    public function cUpdateActor($actorId){
        $myActor = $this->findById($actorId);
        $this->set($myActor);
        $updatedOk = false;
        if($this->validates()){
            $fields = array('Actor.name' => '"'.$myActor['Actor']['name'].'"',
                            'Actor.lastname' => '"'.$myActor['Actor']['lastname'].'"',
                            'Actor.birthdate' => $myActor['Actor']['birthdate']);
            $conditions = array('Actor.id' => $myActor['Actor']['id']);
            
            if($this->updateAll($fields, $conditions) == true) $updatedOk = true;
        }
        return $updatedOk;
    }
}
?>
