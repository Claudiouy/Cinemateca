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
    
    function nueva_pelicula(){
        if(!empty($this->data['Pelicula'])){
             //var_dump($this->data['Pelicula']);
            if($this->Pelicula->save($this->data['Pelicula'])){
                $this->Session->setFlash('La película se salvó correctamente', 'default');   
                $this->redirect('/peliculas/index');
            }
            else{
                $this->Session->setFlash('Error al guardar la película', 'flash_error');
            }
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
       if(!empty($_POST['idSelec'])){
            $ids = $_POST['idSelec'];
            $array_ids = explode(",", $ids);
            var_dump($array_ids);
            #echo $array_ids;
            $condiciones = array('Peliculas.id IN' =>  $ids);
            $this->Pelicula->updateAll(array('Pelicula.activa' => 1), $condiciones);  //no funca, consultar
            #$this->log('Mensajito: '.$ids , LOG_DEBUG);"entra"
            #$this->render('seleccionar_peliculas');
            #$this->render('/peliculas/seleccionar_peliculas');   
       }
           return false;
           
       //seguir con renderizar un elemento con ajax ajaxreturn en marcadores
   }
   
   function consultar_peliculas(){
       
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
