<?php
class Director extends AppModel {
var $name = 'Director';
var $belongsTo = array('State');
public $hasMany = array('DirectorPelicula');

var $validate = array(
        'surname' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Letras y numeros solamente'
                ),
            'between' => array(
            'rule' => array('between', 3, 20),
            'message' => 'Entre 3 y 20 caracteres'
                ))
           
         );
}
?>