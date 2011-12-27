<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pelicula extends AppModel{
    var $name = 'Pelicula';
    public $hasMany = array('ActorPelicula', 'DirectorPelicula','Performance');

    
     var $validate = array(
         'name' => array(
             'rule' => 'notEmpty',
             'message' => 'Debe Indicar un título'
             ),
         'duracion' => array(
             
             'duracion_obligatoria' => array(
                                 'rule' => array('notEmpty'),
                                 'message' => 'Debe indicar una duración mayor que 0'
                                 ),
             'numerica' =>array(
                         
                                 'rule' => 'numeric',
                                 'message' => 'La duración es un dato numérico'
                                 ),
             'mayor_cero' => array(
                     'rule' => array('comparison', '>', 0),
                     'message' => 'El campo duracion es mayor a 0.' 
                     )
             
             ),
         'anio' => array(
             'duracion_obligatoria' => array(
                                 'rule' => array('notEmpty', array('comparison', '>', 0)),
                                 'message' => 'El año debe ser mayor que 0'
                                 ),
             'numerica' =>array(
                         
                                 'rule' => 'numeric',
                                 'message' => 'El año es es un dato numérico'
                                 ),
             'mayor_cero' => array(
                     'rule' => array('comparison', '>', 0),
                     'message' => 'El campo anio es mayor a 0.' 
                     )
             
             
             ), 
         'activa' => array(
             'rule' => 'boolean'     
             
             )
         );
     
     
     
      function limit_years($data){ 
          $actualYear = date('Y');
          return $data <= $actualYear;
          }
}
?>
