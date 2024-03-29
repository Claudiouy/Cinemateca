<?php

class AppController extends Controller {

var $components = array ('Auth', 'Session');  



function beforeFilter() {
$this->Auth->allow('login');    
$this->Auth->authError='Debe estar logueado en el sistema para tener acceso';    
$this->Auth->loginError='Usuario/Clave combinacion inválida .';    
$this->Auth->loginRedirect=array('controller'=>'pages','action'=>'home');    
$this->Auth->logoutRedirect=array('controller'=>'users','action'=>'login');    


$this->set('admin', $this->_isAdmin());
$this->set('logged_in',$this->_LoggedIn());
$this->set('users_username',$this->_usersUsername());
$this->set('users_userRol',$this->_usersUserRol());
}
function _isAdmin (){
    $admin = FALSE;
    if($this->Auth->user('roles')=='admin'){
    $admin = TRUE; 
    }
    return $admin;
}

function _LoggedIn (){
    $logged_in = FALSE;
    if ($this->Auth->user()){
    $logged_in = TRUE;
    }
    return $logged_in;
}
function _usersUsername(){
    $users_username = NULL;
    if($this->Auth->user()){
        $users_username = $this->Auth->user("username");
}
return $users_username;
}

function _usersUserRol(){
    $users_userRol = NULL;
    if($this->Auth->user()){
        $users_userRol = $this->Auth->user("roles");
}
return $users_userRol;
}

function uploadFiles($folder, $formdata, $itemId = null) {  
    // setup dir names absolute and relative  
    $folder_url = WWW_ROOT.$folder;  
    $rel_url = $folder;  
      
    // create the folder if it does not exist  
    if(!is_dir($folder_url)) {  
        mkdir($folder_url);  
    }  
          
    // if itemId is set create an item folder  
    if($itemId) {  
        // set new absolute folder  
        $folder_url = WWW_ROOT.$folder.'/'.$itemId;   
        // set new relative folder  
        $rel_url = $folder.'/'.$itemId;  
        // create directory  
        if(!is_dir($folder_url)) {  
            mkdir($folder_url);  
        }  
    }  
      
    // list of permitted file types, this is only images but documents can be added  
    $permitted = array('image/gif','image/jpeg','image/png', 'image/jpg');  
      
    // loop through and deal with the files  
    foreach($formdata as $file) {  
        // replace spaces with underscores  
        $filename = str_replace(' ', '_', $file['name']);  
        // assume filetype is false  
        $typeOK = false;  

        // check filetype is ok  
        foreach($permitted as $type) {  
            if($type == $file['type']) {  
                $typeOK = true;  
                break;  
            }  
        }  
          
        // if file type ok upload the file  
        if($typeOK) {  
            // switch based on error code  
            switch($file['error']) {  
                case 0:  
                    // check filename already exists  
                    if(!file_exists($folder_url.'/'.$filename)) {  
                        // create full filename  
                        $full_url = $folder_url.'/'.$filename;  
                        $url = $rel_url.'/'.$filename;  
                        // upload the file  
                        $success = move_uploaded_file($file['tmp_name'], $url);  
                    } else {  
                        // create unique filename and upload file  
                        ini_set('date.timezone', 'Europe/London');  
                        $now = date('Y-m-d-His');  
                        $full_url = $folder_url.'/'.$now.$filename;  
                        $url = $rel_url.'/'.$now.$filename;  
                        $success = move_uploaded_file($file['tmp_name'], $url);  
                    }  
                    // if upload was successful  
                 if($success) {  
                        // save the url of the file  
                $result['urls'][] = $url;  
                } else {  
                $result['errors'][] = "Error cargando foto  $filename. Por favor , intente otra vez.";  
                }  
                break;  
                case 3:  
                 // an error occured  
                $result['errors'][] = "Error cargando archivo $filename. Por favor , intente otra vez.";  
                    break;  
                default:  
                 // an error occured  
                 $result['errors'][] = "Error de sistema cargando foto $filename.Pongase en contacto con el administrador.";  
                break;  
                }  
                } elseif($file['error'] == 4) {  
                // no file was selected for upload  
                $result['nofiles'][] = "No ha sido seleccionado un archivo";  
                } else {  
                // unacceptable file type  
                $result['errors'][] = "$filename no puede ser subido. Solo se permiten extensiones: gif, jpg, png.";  
        }  
    }  
return $result;  
}



}

  
?>
