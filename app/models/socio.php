<?php
class Socio extends AppModel {
var $name = 'Socio';
var $hasMany = array('Payment');
var $belongsTo  = array('State','Suscription','PaymentMethod',"Creditcard");

  var $validate = array(
     'name' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un nombre',
     'last' => true),
     
     'surname' => array(
     'rule' => 'notEmpty',
     'message' => 'Favor ingresar un apellido',
     'last' => true),
    
     'fec_nac' => array(
     'rule' => 'date',
     'message' => 'Favor ingrese una fecha de nacimiento',
     'last' => true),
     
     'calle_princ' => array(
     'rule' => 'notEmpty',
     'message' => 'Ingrese una direccion',
     'last' => true),
        
     'tel_fijo' => array(
     'rule' => 'numeric',
     'allowEmpty' => true,    
     'message' => 'Favor ingresar solo numeros',
     'last' => true),
      
     'celular' => array(
     'rule' => 'numeric',
     'allowEmpty' => true,
     'message' => 'Favor ingresar solo numeros',
     'last' => true),
      
     'email' => array(
     'rule' => 'email',
     'allowEmpty' => true,
     'message' => 'Favor ingresar un email valido',
     'last' => true),
      
      
     'documento_identidad' => array(
     'esValida' => array(
     'rule' => 'verficarCI',  
     'message' => 'Ese documento no verifica correctamente',
     'last' => true),
     'soloNumeros' => array(
     'rule' => 'numeric',  
     'message' => 'Debe ser solo numeros sin puntos ni guiones',
     'last' => true),
        
     'esUnico' => array(
     'rule' => 'isUnique',  
     'message' => 'Ese documento ya ha sido ingresado.',
     'last' => true
        ),
         
     'between' => array(
     'rule' => array('between', 5, 8),
     'message' => 'Entre 5 y 8 digitos',
     'last'=> true))
         
     
     
          );
  
  
    function getSocioByDocument($docSocio){
              
        //var_dump($docsocio);
        //debug($docSocio);
        if(!empty($docSocio)){
            $mySocio = $this->find('first', array('conditions' => array('Socio.documento_identidad' => $docSocio)));
        }
        return $mySocio;
    }
    
    function getSociosByName($socioName){
        
        $conditions = array('OR' => array('Socio.name LIKE' => '%'.$socioName.'%',
                                                'Socio.surname LIKE' => '%'.$socioName.'%'));
        
        $socioList = $this->find('all', array('conditions' => $conditions));
        return $socioList;
    }
    
    function cUpdateSocioEffectiveDate($suscription, $mySocio, $numberQuotas ){
        
        $safeDeleteOk = false; 
        
        if( !empty($suscription) && !empty($mySocio) ){
            
            $oldDate = $mySocio['Socio']['effective_date'];
            if(empty($oldDate)) $oldDate = $mySocio['Socio']['created'];
            $months_size = $suscription['Suscription']['length_months'] * $numberQuotas;
            $newDate = date("Y-m-d", strtotime("$oldDate + $months_size months"));
            
            $fields = array('Socio.effective_date' => '"'.$newDate.'"');
            $conditions = array('Socio.id' => $mySocio['Socio']['id']);
            if($this->updateAll($fields, $conditions) == true) $safeDeleteOk = true;
             
        }
        return $safeDeleteOk;
    }
    
    function cValidateSocioUpToDate($idSocio){
        $my_socio = $this->findById($idSocio);
        $isUpToDate = false;
        
        if(!empty($my_socio)){
            $effectiveDate = $my_socio['Socio']['effective_date'];
            $actual_date = date("Y-m-d");
            if($actual_date < $effectiveDate) $isUpToDate = true;
        }
        return $isUpToDate;
    }
    
    function cGetUpToDateSocios(){
        
        $conditions = array('Socio.effective_date >'  => date('Y-m-d'));
        $upToDateSocios = $this->find('count', array('conditions' => $conditions));
        return $upToDateSocios;
    }
    
    function getUpToDatePieData(){
        $upToDateSize = $this->cGetUpToDateSocios();
        $socioSize = $this->find('count');
        $pieData[] = array('Al dia' => $upToDateSize);
        $pieData[] = array('Con deuda' => $socioSize - $upToDateSize);
        
        return $pieData;
    }
    
    function getSociosByAge(){
        $listOfSocios = $this->find('all');
        $arrayToReturn = array();
        $arrayData = array();
        for( $i = 0; $i < 5; $i ++ ){
            $arrayData[$i] = 0;
        }
        foreach($listOfSocios as $soc){           
            $socioAge = (time() - strtotime($soc['Socio']['fec_nac'])) / 60 / 60 / 24 / 365;
            $indexToAdd = $this->getPositionFromAge($socioAge);
            $arrayData[$indexToAdd] ++; 
        }
        $arrayToReturn['Menos de 20'] = $arrayData[0];
        $arrayToReturn['Entre 20 y 34'] = $arrayData[1];
        $arrayToReturn['Entre 35 y 49'] = $arrayData[2];
        $arrayToReturn['Entre 50 y 65'] = $arrayData[3];
        $arrayToReturn['66 o mas'] = $arrayData[4];
        return $arrayToReturn;
    }
    
    function getPositionFromAge($age){
        
        if( $age < 20 ) return 0;
        if( 20 <= $age && $age < 35 ) return 1;
        if( 35 <= $age && $age < 50 ) return 2;
        if( 50 <= $age && $age < 65 ) return 3;
        if( 65 <= $age ) return 4;
    }
    
    function  reduceEffectiveDate($socio_id, $month_size){
        
        $mySocio = $this->findById($socio_id);
        
        if(!empty($mySocio)){
            $oldDate = $mySocio['Socio']['effective_date'];
            $newDate = date("Y-m-d", strtotime("$oldDate - $month_size months"));
            
            $fields = array('Socio.effective_date' => '"'.$newDate.'"');
            $conditions = array('Socio.id' => $mySocio['Socio']['id']);
            if($this->updateAll($fields, $conditions) == true) $correctlyUpdated = true;
        }
    }



function verficarCI($data) {


if(1==1){
//Inicializo los coefcientes en el orden correcto
        $arrCoefs = array(2,9,8,7,6,3,4,1);
        //saco caracteres extraños de la ci recibida
        $suma = 0;
        //Para el caso en el que la CI tiene menos de 8 digitos
        //calculo cuantos coeficientes no voy a usar
        $largoval =count($arrCoefs);
        $ci=$data['documento_identidad'];
        $largo =strlen($data['documento_identidad']);
        $difCoef = ($largoval - $largo);
        
    if($largo < 9 && $largo > 2){
            for ($i = $largo - 1; $i > -1; $i--) {
            $dig = substr($ci,$i, 1);
            $digInt = intval($dig);
            $coef = $arrCoefs[$i + $difCoef];
            $suma = $suma + ($digInt * $coef);
            
        }
   
        if ( ($suma % 10) == 0 ) {
return true;
} else {
return false;
} }
return false;
    
}else {

return true;
}        

    }   


    
function generaDeuda($suscripcion) {
    switch ($suscripcion) {
    case 2:
        break;
    case 13:
        break;
    case 12:
        break;
{
        ;
}

}
}
}
   

?>