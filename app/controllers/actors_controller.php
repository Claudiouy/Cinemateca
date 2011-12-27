<?php


class ActorsController extends AppController{
    var $name = 'Actors';
    var $hasMany = array('Peliculas');
    
    
    var $paginate = array(
                        'limit' => 25,
                        'order' => array('Actor.created' => 'desc')
                        );
    

    function index(){
        $this->Actor->recursive = 0;
        $conditions = array('Actor.deleted = ' => 0);
        $this->set('allActors', $this->paginate('Actor', $conditions));
    }
    
    function new_actor(){
        if(!empty($this->data['Actor'])){
            
            $message = '';
            if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
                 if($_FILES['upfile']['size'] < 1048576 && (($_FILES["upfile"]["type"] == "image/gif")
                                                                || ($_FILES["upfile"]["type"] == "image/jpeg")
                                                                || ($_FILES["upfile"]["type"] == "image/jpg")
                                                                || ($_FILES["upfile"]["type"] == "image/png"))){
                                        move_uploaded_file($_FILES['upfile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/cake_primero/app/webroot/img/imgPelis/'.(string)time().$_FILES['upfile']['name'] );
                                        $this->data['Actor']['image_path'] = (string)time().$_FILES['upfile']['name'];
                                                                }
                                                                else{
                                                                    $message += ' La imagen no se subió porque no era una imagen compatible o porque pesaba mas de 1 mega.';
                                                                }
                
            }
            
            if($this->Actor->save($this->data['Actor'])){
                $this->Session->setFlash('El actor se guardó correctamente', 'default');   
                $this->redirect('/actors');
            }
            else {
                $this->Session->setFlash('Error al guardar el actor', 'default');
            }
        }
    }
    
    function edit_actor(){
        if(!empty($this->params['pass']['0'])){
            $my_actor = $this->Actor->getActorById($this->params['pass']['0']);
            $this->set('my_actor', $my_actor);
        }
        else{
            $this->redirect('/actors');
        }
    }
    
    function edit_actor_proccess(){
        if(!empty($this->data['Actor'])){
            $message = '';
            if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
                if($_FILES['upfile']['size'] < 1048576 && (($_FILES["upfile"]["type"] == "image/gif")
                                                                || ($_FILES["upfile"]["type"] == "image/jpeg")
                                                                || ($_FILES["upfile"]["type"] == "image/jpg")
                                                                || ($_FILES["upfile"]["type"] == "image/png"))){
                                move_uploaded_file($_FILES['upfile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/cake_primero/app/webroot/img/imgPelis/'.(string)time().$_FILES['upfile']['name'] );
                                $this->data['Actor']['image_path'] = (string)time().$_FILES['upfile']['name'];
                                $correctly_updated = $this->Actor->cUpdateActor($this->data['Actor']['id'], $this->data['Actor']['name'], $this->data['Actor']['lastname'], $this->data['Actor']['birthdate'], $this->data['Actor']['nacionality'], $this->data['Actor']['image_path']);
                                                                }
                                                                else{
                                                                   $message += ' La imagen no se subió porque no era una imagen compatible o porque pesaba mas de 1 mega.'; 
                                                                }
                                
                }
                else{
                    $correctly_updated = $this->Actor->cUpdateActor($this->data['Actor']['id'], $this->data['Actor']['name'], $this->data['Actor']['lastname'], $this->data['Actor']['birthdate'], $this->data['Actor']['nacionality'], null);
                }
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
            $this->redirect('/actors');
        }
    }
    
    function remove_actor(){
        
        if(!empty($this->params['pass']['0'])){
            
            $actor_id_to_delete = $this->params['pass']['0'];
            
            if(!$this->Actor->safeDelete($actor_id_to_delete)){
                $this->Session->setFlash('Error al eliminar el actor');
                $allActors = $this->find('all');
            }
        }
        $this->redirect('/actors');
    }
    
    function isUploadedFile($params){
            $val = array_shift($params);
            if ((isset($val['error']) && $val['error'] == 0) ||
            (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')) {
                    return is_uploaded_file($val['tmp_name']);
            }
            return false;
    }

}
?>
