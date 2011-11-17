<?php
class Performance extends AppModel{
    
    var $name = 'Performance';
    var $belongsTo = array('Pelicula','Sala');
}
?>