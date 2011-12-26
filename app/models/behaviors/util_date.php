<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UtilDateBehavior extends ModelBehavior {
    
    /*
     * Devuelve un listado de objetos del modelo seleccionado entre la fecha de inicio y fin pasadas por parametro.
     */
    public function list_between_dates(&$Model, $from, $to){
        
        $conditions = array('AND' => array("{$Model->alias}.created >=" => $from,
                                            "{$Model->alias}.created <=" => $to));                                   
        $listOfObject= $Model->find('all', array('conditions' => $conditions));
        
        $days_diff = $this->get_days_diff($from, $to);
        for( $i = 0; $i < 12 && $i <= $days_diff; $i++ ){
            
        }
        return $listOfObject;
    }

    
    /*
     * Devuelve un array con el listado de leyendas que debe tener cada columna
     */
    public function get_legend_data(&$Model, $from, $to){
        
        $legend_array = array();
        $diff_date = $this->get_days_diff($from, $to);
        
        // Aca obtengo la diferencia en dias entre las columnas 
        $diff_between_columns;
        if($diff_date >= 12){
            $diff_between_columns = $diff_date / 12;
            $diff_between_columns = round($diff_between_columns);
        }
        else {
            $diff_between_columns = 1;
        }
        
        for( $i = 1; $i < 13 && $i <= $diff_date; $i++){
            if($diff_date >= 12){
                $days_to_add = $diff_between_columns * $i;
                if($diff_between_columns > 30){
                    $newDate = $this->translateSpanish(strtotime(date("Y-F-d", strtotime("$from + $days_to_add days"))), false);
                }
                else {
                    $newDate = $this->translateSpanish(strtotime(date("Y-m-d", strtotime("$from + $days_to_add days"))), true);
                }
                $legend_array[] = $newDate;
            }
            else{
                $newDate = $this->translateSpanish(strtotime(date("Y-m-d", strtotime("$from + $i days"))), true);
                $legend_array[] = $newDate;
            }
        }
        return $legend_array;
    }   
   
    public function get_days_diff($from, $to){
        
        $unix_time_from = strtotime($from);
        $unix_time_to = strtotime($to);
        $days_of_diff =  ($unix_time_to - $unix_time_from) / (60 * 60 * 24);
        $days_of_diff = abs($days_of_diff);
        $days_of_diff = floor($days_of_diff);
        return $days_of_diff;   
    }
    
    /*
     * Devuelve el listado de los valores para insertar en la grafica
     */
    public function get_data_array(&$Model, $from, $to, $string_attribute){
        
        $days_diff = $this->get_days_diff($from, $to);
        
        $monthsArray = array();
        for($i=1; $i < 13 && $i <= $days_diff ;$i++){
            $monthsArray[$i] = 0;
        }
        
        $listP = $this->list_between_dates($Model, $from, $to);
        foreach ($listP as $pay) {
            
            $my_date = date('Y-m-d', strtotime($pay[$Model->alias]['created']));
            
            if($days_diff >= 12){
                $columnDays = $days_diff / 12;
                $columnDays = round($columnDays);
            }
            else{
                $columnDays = 1;
            }
            
            $dummyTo = date("Y-m-d", strtotime("$from + $columnDays days"));            
            $found = true;
            for($e = 1; $e < 13 && $e <= $days_diff && $found; $e ++){
                               
                if($my_date <= $dummyTo){
                    
                    if($string_attribute != null){
                        $monthsArray[$e] = $monthsArray[$e] + $pay[$Model->alias][$string_attribute];
                    }
                    else{
                        $monthsArray[$e] ++;
                    }
                    $found = false;
                }
                else{
                    $dummyTo = date("Y-m-d", strtotime("$dummyTo + $columnDays days"));
                }
            }
            
        }
        return $monthsArray;
    }
    
    public function translateSpanish($my_date, $long_format){
        
        if(!empty($my_date)){

            // Obtenemos el número del día
            $dia=date("d", $my_date);

            // Obtenemos y traducimos el nombre del mes
            $mes=date("F", $my_date);
            if ($mes=="January") $mes="Enero";
            if ($mes=="February") $mes="Febrero";
            if ($mes=="March") $mes="Marzo";
            if ($mes=="April") $mes="Abril";
            if ($mes=="May") $mes="Mayo";
            if ($mes=="June") $mes="Junio";
            if ($mes=="July") $mes="Julio";
            if ($mes=="August") $mes="Agosto";
            if ($mes=="September") $mes="Setiembre";
            if ($mes=="October") $mes="Octubre";
            if ($mes=="November") $mes="Noviembre";
            if ($mes=="December") $mes="Diciembre";

            // Obtenemos el año
            $anio=date("Y", $my_date);
        }
        if($long_format){
            return $dia. ' de ' .$mes. ' de '. $anio;
        }
        else {
            return  $mes. ' de ' . $anio;
        }
        
    }
}
?>
