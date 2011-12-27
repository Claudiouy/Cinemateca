<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PeliculasController extends AppController{
    var $name = 'Peliculas'; 
    var $hasMany = array('Actors, Directors');
    var $components = array('RequestHandler');
    
    function index(){
        $this->Pelicula->recursive = 0;
        $this->loadModel('Actor');
        $this->loadModel('Director');
        $conditions1 = array('Actor.deleted = ' => 0);
        $allActors = $this->Actor->find('all', array('conditions' => $conditions1));
        $allDirectors = $this->Director->find('all');
        $this->set('allAct', $allActors);
        $this->set('allDir', $allDirectors);
        $conditions = array('Pelicula.deleted = ' => 0);
        $this->set('peliculas', $this->paginate('Pelicula', $conditions));
    }
    
    function detalle(){
        if(!empty($this->params['pass']['0'])){
            $pelicula_id = $this->params['pass']['0'];
            $mi_peli = $this->Pelicula->find('id =', $pelicula_id);
            $this->set('la_peli', $mi_peli['Pelicula']);
            
        }
    }
    
    function nueva_pelicula(){
        if(!empty($this->data['Pelicula'])){
             //var_dump($this->data['Pelicula']);
            if(is_uploaded_file($_FILES['upfilePel']['tmp_name'])){
                    move_uploaded_file($_FILES['upfilePel']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/cake_primero/app/webroot/img/imgPelis/'.(string)time().$_FILES['upfilePel']['name'] );
                    $this->data['Pelicula']['image_path'] = (string)time().$_FILES['upfilePel']['name'];
            }
                
            if($this->Pelicula->save($this->data['Pelicula'])){
                $this->Session->setFlash('La película se salvó correctamente', 'default');
            }
            else {
                $this->Session->setFlash('Error al guardar la película', 'flash_error');
            }
        }
        $this->redirect('/peliculas/index');
    }
    
    function editar_pelicula(){
        
        #Si lo recibe por get viene del listado, por post es el envio del formulario
        if(!empty($this->data['Pelicula'])){           
            $nueva_pelicula = $this->data['Pelicula'];
            $this->Pelicula->set($nueva_pelicula);
            
            if($this->Pelicula->validates()){ //necesario, ya que validates() valida el metodo save(), no el update()               
                if(is_uploaded_file($_FILES['upfilePel']['tmp_name'])){
                            move_uploaded_file($_FILES['upfilePel']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/cake_primero/app/webroot/img/imgPelis/'.(string)time().$_FILES['upfilePel']['name'] );
                            $this->Pelicula->updateAll(
                                                    array('Pelicula.name' => '"'.$nueva_pelicula['name'].'"',
                                                          'Pelicula.duracion' => $nueva_pelicula['duracion'],
                                                          'Pelicula.anio' => $nueva_pelicula['anio'],
                                                          'Pelicula.country' => $nueva_pelicula['country'],
                                                          'Pelicula.descripcion' => '"'.$nueva_pelicula['descripcion'].'"',
                                                          'Pelicula.image_path' => '"'.(string)time().$_FILES['upfilePel']['name'].'"',  
                                                          'Pelicula.activa' => $nueva_pelicula['activa']),
                                                          
                                                    array('Pelicula.id' => $nueva_pelicula['id'])
                                                    );
                        }
                        else{
                            $this->Pelicula->updateAll(
                                                    array('Pelicula.name' => '"'.$nueva_pelicula['name'].'"',
                                                          'Pelicula.duracion' => $nueva_pelicula['duracion'],
                                                          'Pelicula.country' => $nueva_pelicula['country'],
                                                          'Pelicula.anio' => $nueva_pelicula['anio'],
                                                          'Pelicula.descripcion' => '"'.$nueva_pelicula['descripcion'].'"',
                                                          'Pelicula.activa' => $nueva_pelicula['activa']),
                                                    array('Pelicula.id' => $nueva_pelicula['id'])
                                                    );
                        }
                
           
                 $this->redirect("/peliculas");
            }
            #$this->render('/peliculas/editar_pelicula/'.$nueva_pelicula['id']);
            $this->Session->setFlash('Error al guardar la película', 'flash_error');
            $this->redirect('/peliculas/editar_pelicula/'.$nueva_pelicula['id']);
        }
        else { 
            $this->loadModel('Actor');
            $this->loadModel('Director');
            $allActors = $this->Actor->find('all');
            $allDirectors = $this->Director->find('all');
            $this->set('allAct', $allActors);
            $this->set('allDir', $allDirectors);
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
            $filtros =  array("Pelicula.name LIKE" => "%".$nombre_peli."%");
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
       if(!empty($_POST['idSelec']) || !empty($_POST['idNoSelec'])){
            
            if(!empty($_POST['idSelec'])){
                $ids = $_POST['idSelec'];
                $idsStr = explode(',', $ids);
                $ids = implode('","', $idsStr);
                $condiciones = 'Pelicula.id IN ("' .$ids .'")';
                $this->Pelicula->updateAll(array('Pelicula.activa' => 1), $condiciones); 
            }
            
            if(!empty($_POST['idNoSelec'])) {
                $idsNot = $_POST['idNoSelec'];
                $idsStr = explode(',', $idsNot);
                $idsNot = implode('","', $idsStr);
                $condicionesNot = 'Pelicula.id IN ("' .$idsNot .'")';
                $this->Pelicula->updateAll(array('Pelicula.activa' => 0), $condicionesNot);
            }  
              
       }
       $this->redirect('/peliculas/seleccionar_peliculas');
   }
   
   function consultar_peliculas(){
       
   }
   
   function otra_consulta(){
       if(!empty($_POST['miNombre'])){
           $nombreParcial = $_POST['miNombre'];
           $filtros =  array("Pelicula.name LIKE" => "%".$nombreParcial."%");
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
       $this->redirect('/peliculas');
   }
   
   /*
    * Devuelve el div con peliculas en cartel
    */
   function json_peliculas_activas(){
       $this->Pelicula->recursive = 2;
       $conditions = array('Pelicula.activa = 1');
       $activePeliculas = $this->Pelicula->find('all', array('conditions' => $conditions));
       $this->set('activePeliculas', $activePeliculas);
       $this->render('/elements/maquetado_pelicula');
   }
   
   function json_peliculas_activas2(){
       $this->render('/elements/maquetado_pelicula');
   }
   

    
}


?>
