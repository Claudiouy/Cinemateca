<?php
class Director extends AppModel {
var $name = 'Director';
var $belongsTo = array('State');
public $hasMany = array('DirectorPelicula');

}
?>