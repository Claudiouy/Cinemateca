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
            else {
                $this->Session->setFlash('Error al guardar la película', 'flash_error');
            }
        }
    }
    
    function editar_pelicula(){
        
        #Si lo recibe por post viene del listado, por get es el envio del formulario
        if(!empty($this->data['Pelicula'])){           
            $nueva_pelicula = $this->data['Pelicula'];
            $this->Pelicula->set($nueva_pelicula);   
            
            if($this->Pelicula->validates()){ //necesario, ya que validates() valida el metodo save(), no el update()               
                $this->Pelicula->updateAll(
                    array('Pelicula.titulo' => '"'.$nueva_pelicula['titulo'].'"',
                          'Pelicula.duracion' => $nueva_pelicula['duracion'],
                          'Pelicula.anio' => $nueva_pelicula['anio'],
                          'Pelicula.activa' => $nueva_pelicula['activa']),
                    array('Pelicula.id' => $nueva_pelicula['id'])
                    );
           
                 $this->redirect("/peliculas");
            }
            #$this->render('/peliculas/editar_pelicula/'.$nueva_pelicula['id']);
            $this->Session->setFlash('Error al guardar la película', 'flash_error');
            $this->redirect('/peliculas/editar_pelicula/'.$nueva_pelicula['id']);
        }
        else { 
            
            if(!empty($this->params['pass']['0'])){               
                $id_pelicula = $this->params['pass']['0'];
                $mi_pelicula = $this->Pelicula->findById($id_pelicula);
                
                if(!empty($mi_pelicula)){
                   $this->set('mi_pelicula', $mi_pelicula);     
                }
                
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
   
   function graficar_peliculas(){   
       
   }
   
   function eliminar_pelicula(){
       
       if(!empty($this->params['pass']['0'])){
           $id_a_eliminar = $this->params['pass']['0'];
           if(!$this->Pelicula->delete($id_a_eliminar)){
               $this->Session->setFlash('Error al eliminar la película');
           }           
       }
       $this->redirect('/peliculas/index');
   }
    
}


?>
