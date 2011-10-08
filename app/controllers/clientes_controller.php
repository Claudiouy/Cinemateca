<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClientesController extends AppController{
    var $components    = array('Cookie');
    var $name = 'Clientes';
    
    function index(){
        
        #var_dump($this->Cookie->nombre);
        #var_dump($this->components);
        #if(!empty($this->Cookie->read('usuarioLogueado'))){
         #   $this->Cookie->write('nombre','nuevo', false);
        #}
        #else{
         #   $this->Cookie->write('nombre','ya hay cookie', false);
        #}
        
        $my_clientes = $this->Cliente->find('all');
        $this->set('clientela', $my_clientes);
    }
    
    function nuevo(){
        if(!empty($this->data["Cliente"])){
            if($this->Cliente->save($this->data["Cliente"])) {
                $this->redirect("/clientes");
            }
            else{
                $this->redirect("/clientes/nuevo");
            }
        }
    }
    
    function editar(){
        
        if(!empty($this->data["Cliente"])){            
            $cliente_act = $this->data["Cliente"];
            #var_dump($cliente_act);
            $this->Cliente->updateAll(
                    array('Cliente.edad' => $cliente_act['edad'],
                            'Cliente.nombre' => '"'.$cliente_act['nombre'].'"',
                            'Cliente.apellido' => '"'.$cliente_act['apellido'].'"'),
                    array('Cliente.id =' => $cliente_act['id'])
                    );
            $this->redirect("/clientes");
        }
        else{
           if(!empty($this->params['pass']['0'])){
                $mi_cliente = $this->Cliente->findById($this->params['pass']['0']);
                if($mi_cliente != NULL){
                   $this->set('mi_cliente', $mi_cliente); 
                }

            }  
        }
        
    }
    
    function cambiar_edad(){
        $this->Cliente->updateAll(
                array('Cliente.edad' => 19),
                array('Cliente.edad <=' => 18)
                );
        $this->redirect('/clientes');
    }
    
    function eliminar(){
        #var_dump($this->params['pass']);
        $this->Cliente->delete($this->params['pass']['0']);     
        $this->redirect('/clientes');
    }
    
}
?>
