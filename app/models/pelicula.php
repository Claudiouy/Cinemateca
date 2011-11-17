<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pelicula extends AppModel{
    var $name = 'Pelicula';
    public $hasMany = array('ActorPelicula', 'DirectorPelicula');
    
    
     var $validate = array(
         'titulo' => array(
             'rule' => 'notEmpty',
             'message' => 'Debe Indicar un título'
             ),
         'duracion' => array(
             
             'duracion_obligatoria' => array(
                                 'rule' => array('notEmpty', array('comparison', '>', 0)),
                                 'message' => 'Debe indicar una duración mayor que 0'
                                 ),
             'numerica' =>array(
                 
             
                                 'rule' => 'numeric',
                                 'message' => 'La duración es un dato numérico'
                                 )
             
             ),
         'anio' => array(
             'rule' => 'notEmpty',
             'message' => 'Debe indicar año de estreno'
             ), 
         'activa' => array(
             'rule' => 'boolean'     
             
             )
         );
}
?>
