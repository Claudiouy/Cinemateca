<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Actor extends AppModel{
    var $name = 'Actor';
    public $hasMany = array('ActorPelicula');
    
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
                'no_vacia' => array(
                                 'rule' => 'notEmpty',      
                                 'message' => 'La fecha de nacimento es un campo requerido'
                    ),
                
                    
             )       
    );
    
    
    public function getAllActors(){
        $actors = $this->find('all', array('conditions' => array('Actor.deleted' => 0)));
        return $actors;
    }
    
    public function getActorById($actorId){
        $myActor = $this->findById($actorId);
        return $myActor;
    }
    
    public function cUpdateActor($actorId, $actorName, $actorLastname, $actorBirthdate,$actorNacionality, $actorImagePath){
        $updatedOk = false;
        $my_date = '';
        $my_date = "'".$actorBirthdate['year']."-".$actorBirthdate['month']."-".$actorBirthdate['day']."'";
        if(!empty($actorImagePath)){
            $fields = array('Actor.name' => '"'.$actorName.'"',
                            'Actor.image_path' => '"'.$actorImagePath.'"',
                            'Actor.lastname' => '"'.$actorLastname.'"' ,
                            'Actor.nacionality' => '"'.$actorNacionality.'"',
                            'Actor.birthdate' => $my_date);
        }
        else{
            $fields = array('Actor.name' => '"'.$actorName.'"',
                            'Actor.lastname' => '"'.$actorLastname.'"' ,
                            'Actor.nacionality' => '"'.$actorNacionality.'"',
                            'Actor.birthdate' => $my_date);
        }
        $conditions = array('Actor.id' => $actorId);
        
        if($this->updateAll($fields, $conditions) == true) $updatedOk = true;
        
        return $updatedOk;
    }
    
    public function safeDelete($actorId){
        
        $safeDeleteOk = false;
        $fields = array('Actor.deleted' => 1);
        $conditions = array('Actor.id' => $actorId);

        if($this->updateAll($fields, $conditions) == true) $safeDeleteOk = true;
        
        return $safeDeleteOk;
    }
    
    
      function limit_date($data){ 
          $actualYear = date('Y-m-d');
          return $data <= $actualYear;
      }
}
?>
