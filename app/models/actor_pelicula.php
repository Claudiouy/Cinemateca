<?php


class ActorPelicula extends AppModel{
    
    var $belongsTo = array('Actor', 'Pelicula');
}

?>
