<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ActorsController extends AppController{
    var $name = 'Actors';
    
    
    function index(){
        $allActors = $this->Actor->getAllActors();
        $this->set('allActors', $allActors);
    }
    
    function new_actor(){
        if(!empty($this->data['Actor'])){
            if($this->Actor->save($this->data['Actor'])){
                $this->Session->setFlash('El actor se guardó correctamente', 'default');   
                $this->redirect('/actors/index');
            }
            else {
                echo 'asdfasd';
                $this->Session->setFlash('Error al guardar el actor', 'default');
            }
        }
    }
    
    function edit_actor(){
        if(!empty($this->data['Actor'])){
            $correctly_updated = $this->Actor->cUpdateActor($this->data['Actor']['id']);
            if($correctly_updated){
                $this->Session->setFlash('El actor se guardó correctamente', 'default');
                $this->redirect('/actors');
            }
            else{
                $this->Session->setFlash('Error al guardar el actor', 'default');
                $this->redirect('/actors/edit_actor/'.$this->data['Actor']['id']);
            }
        }
        else{
            if(!empty($this->params['pass']['0'])){
                $my_actor = $this->Actor->getActorById($this->params['pass']['0']);
                $this->set('my_actor', $my_actor);
            }
            else{
                $this->redirect('/actors');
            }
        }
    }
    
    function remove_actor(){
        if(!empty($this->params['pass']['0'])){
            $actor_id_to_delete = $this->params['pass']['0'];
             if(!$this->Actor->delete($actor_id_to_delete)){
                 $this->Session->setFlash('Error al eliminar el actor');
             }
        }
        $this->redirect('/actors');
    }
}
?>
