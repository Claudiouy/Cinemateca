<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PeliculasController extends AppController{
    var $name = 'Peliculas';
    
    function index(){
        $mis_pelis = $this->Pelicula->find('all'); 
        $this->set('pelis', $mis_pelis);
    }
    
    function detalle(){
        if(!empty($this->params['pass']['0'])){
            $pelicula_id = $this->params['pass']['0'];
            $mi_peli = $this->Pelicula->findById($pelicula_id);
            $this->set('la_peli', $mi_peli['Pelicula']);
            
        }
    }
    
    function seleccionar_peliculas(){
        if(!empty($this->data['Pelicula']['nombre'])){
            $nombre_peli = $this->data['Pelicula']['nombre'];
            $filtros =  array("Pelicula.titulo LIKE" => "%".$nombre_peli."%");
            # tambien puede hacerse asi -> $filtros = 'Pelicula.nombre LIKE %"'.$nombre_peli.'"%';
            $listaPorPelicula = $this->Pelicula->find('all', array('conditions' => $filtros));
            $this->set('seleccionPelis', $listaPorPelicula);
        }
        else{
            $mis_pelis = $this->Pelicula->find('all');
            $this->set('seleccionPelis', $mis_pelis);
        }
    }
    
   function activar_peliculas(){
        $mis_pelis = $this->Pelicula->find('all');
        $this->Pelicula->updateAll(array('Pelicula.activa' => 0));
        #return $mi_peli;
        #$this->render('seleccionar_peliculas');
        $this->redirect('/peliculas/seleccionar_peliculas');
           
       
   }
    
}


?>
