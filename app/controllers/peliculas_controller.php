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
        
        $ids = $this->data;
        $array_ids = explode(",", $ids);  
        $condiciones = array('Peliculas.id in' =>  $array_ids);
        $this->Pelicula->updateAll(array('Pelicula.activa' => 1), $condiciones);
        #$this->log('Mensajito: '.$condiciones[0] , LOG_DEBUG);
        $this->render('seleccionar_peliculas');
        #$this->render('/peliculas/seleccionar_peliculas');
           
       //seguir con renderizar un elemento con ajax ajaxreturn en marcadores
   }
    
}


?>
