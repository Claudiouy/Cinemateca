<?php


class DirectorPelicula extends AppModel{
    
    var $belongsTo = array('Director', 'Pelicula');
}

?>