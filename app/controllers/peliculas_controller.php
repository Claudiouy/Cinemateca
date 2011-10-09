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
        
       if(!empty($_POST['idSel'])){
            echo 'entra';
            $ids = $this->data['Pelicula']['id'];
            echo $ids;
            $array_ids = explode(",", $ids);  
            $condiciones = array('Peliculas.id IN' =>  $array_ids);
            $this->Pelicula->updateAll(array('Pelicula.activa' => 1), $condiciones);  //no funca, consultar
            #$this->log('Mensajito: '.$ids , LOG_DEBUG);"entra"
            $this->render('seleccionar_peliculas');
            #$this->render('/peliculas/seleccionar_peliculas');   
       }
       else{
           echo 'no entra';
           $this->render('seleccionar_peliculas');
       }
           
       //seguir con renderizar un elemento con ajax ajaxreturn en marcadores
   }
   
   function consultar_peliculas(){
       if($_POST){
           var_dump($_POST);
           #$nombrePeli = 
           $mis_pelis = $this->Pelicula->find('all');
           #$this->render('/elements/listado_peliculas'); 
       }
       else{
           echo 'ssa';
           $mis_pelis = $this->Pelicula->find('all');
           #$this->render('/elements/listado_peliculas');           
       }
   }
   
   function otra_consulta(){
       if(!empty($_POST['miNombre'])){
           $nombreParcial = $_POST['miNombre'];
           $filtros =  array("Pelicula.titulo LIKE" => "%".$nombreParcial."%");
           $listaPorPelicula = $this->Pelicula->find('all', array('conditions' => $filtros));
           #var_dump($listadoFiltrado);
           $this->set('listadoFiltrado', $listaPorPelicula);
       }
       $this->render('/elements/listado_peliculas'); 
   }
    
}


?>
