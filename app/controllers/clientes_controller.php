<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClientesController extends AppController{
    
    var $name = 'Clientes';
    
    function index(){
        $my_clientes = $this->Cliente->find('all');
        $this->set('clientela', $my_clientes);
    }
    
}
?>
