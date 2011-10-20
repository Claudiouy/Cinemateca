<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class  UsuariosController extends AppController{
    
    var $name = 'Usuarios';
    var $components    = array('Cookie');
    
    /*
    function beforeFilter() { 
        $this->Cookie->name = 'usuarioLogueado';  
        $this->Cookie->time =  3600;  
        // o '1 hour'  
        $this->Cookie->path = '/bakers/preferencias/';  
        $this->Cookie->domain = 'example.com';    
        $this->Cookie->secure = true;  
        //enviar sólo por una conexión segura HTTPS 
        $this->Cookie->key = 'qSI232qs*&sXOw!';
        
        
    }*/
    
    function login(){
        if(!empty($this->data['Usuario'])){
            $mi_usuario = $this->data['Usuario'];
            if(!empty($mi_usuario['nombre']) && !empty($mi_usuario['pass'])){
                if($this->Usuario->find('count', array('conditions' => array('nombre' => $mi_usuario['nombre'], 'password' => $mi_usuario['pass']))) > 0){
                    $this->Session->setFlash('Logueado exitosamente.', 'flash_success');
                    $this->redirect('/usuarios/principal');
                }
                else{
                    
                    $this->redirect('/');
                }
            }
            else{
                $this->redirect('/');
            }
        }
    }
    
    function principal(){
       
        #if(!empty($this->Cookie->read('usuarioLogueado'))){
         #    $this->Cookie->write('nombre','nuevo', false);
        #}
    }
}
?>
