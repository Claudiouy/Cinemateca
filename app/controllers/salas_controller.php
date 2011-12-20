<?php
class SalasController extends AppController {
var $name =  'Salas';


    function write_global_sala_id(){
        
        if(!empty($_POST['idSala'])){
            $idGlobalSala = $_POST['idSala'];
            //Configure::write('Sala.id',$idGlobalSala);
            $this->Session->write("SalaId", $idGlobalSala);
            $this->autoRender=false;
            return 'true';
        }
        return 'false';
    }
}
?>