<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    class Cliente extends AppModel {
         var $name = 'Cliente';
         
         var $validate = array(
             'nombre' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'No hay nombre'
             ),
             'apellido' => array(
                 'rule' => 'notEmpty',      
                 'message' => 'No hay apellido'
             ),
             'edad' => array(   
                 'rule' => array('comparison', '>=', 18), 
                 'message' => 'Debe tener al menos 18 años para calificar.'   
             )
             
         );
    }
?>
