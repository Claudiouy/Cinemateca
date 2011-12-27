<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SuscriptionsController extends AppController{
    
    var $name = 'Suscriptions';
    
    var $paginate = array(
                        'limit' => 25,
                        'order' => array('Suscription.created' => 'desc')
                        );
    
    function beforeFilter(){
        
        parent::beforeFilter();
        $this->Auth->allow('logout');
        
        if($this->action == 'index'|| $this->action == 'edit_suscription' || $this->action == 'new_suscription'){
            if($this->viewVars['admin'] == false){
                $this->Session->setFlash('Solo usuarios administrativos pueden ingresar a Suscripción');
                $this->redirect('/');
            }
        }
       
    }
    
    function index(){
        $this->Pelicula->recursive = 0;
        $conditions = array('Suscription.deleted = ' => 0);
        $this->set('suscriptions', $this->paginate('Suscription', $conditions));
    }
    
    function new_suscription(){
         if(!empty($this->data['Suscription'])){
            if($this->Suscription->save($this->data['Suscription'])){
                $this->Session->setFlash('La suscripción se guardó correctamente', 'default');   
                $this->redirect('/suscriptions');
            }
            else {
                $this->Session->setFlash('Error al guardar la suscripción', 'default');
            }
        }
    }
    
    function edit_suscription(){
        if(!empty($this->params['pass']['0'])){
            $my_suscription = $this->Suscription->findById($this->params['pass']['0']);
            $this->set('my_suscription', $my_suscription);
        }
        else{
            $this->redirect('/suscriptions');
        }
    }
    
    function edit_suscription_proccess(){
        if(!empty($this->data['Suscription'])){
            $correctly_updated = $this->Suscription->cUpdateSuscription($this->data['Suscription']['id'], $this->data['Suscription']['name'], $this->data['Suscription']['description'], $this->data['Suscription']['length_months'],$this->data['Suscription']['amount'] );
            if($correctly_updated){
                $this->Session->setFlash('La suscripción se guardó correctamente', 'default');
                $this->redirect('/suscriptions');
            }
            else{
                $this->Session->setFlash('Error al guardar la suscripción', 'default');
                $this->redirect('/suscriptions/edit_suscription'.$this->data['Suscription']['id']);
            }
        }
        else{
            $this->redirect('/suscriptions');
        }
    }
    
    function remove_suscription(){
        
        if(!empty($this->params['pass']['0'])){
            
            $suscription_id_to_delete = $this->params['pass']['0'];
            $this->loadModel('Socio');
            $conditions = array('Socio.suscription_id' => $suscription_id_to_delete);
            $sizeOfSocios = $this->Socio->find('count', array('conditions' => $conditions));
            if($sizeOfSocios == 0){
                if(!$this->Suscription->safeDelete($suscription_id_to_delete)){
                    $this->Session->setFlash('Error al eliminar la suscripción');
                    $allSuscriptions = $this->find('all');
                }
                else{
                    $this->Session->setFlash('Suscripción borrada', 'default'); 
                }
            }
            else{
               $this->Session->setFlash('No se puede borrar una suscripción con socios asociados', 'default'); 
            }
        }
        $this->redirect('/suscriptions');
    }
}
?>
