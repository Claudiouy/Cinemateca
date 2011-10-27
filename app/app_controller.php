<?php

class AppController extends Controller {
    var $components = array ('Auth', 'Session');
    
    function beforeFilter() {
$this->Auth->allow('login');    
$this->Auth->authError='Debe estar logueado en el sistema para tener acceso';    
$this->Auth->loginError='Usuario/Clave combinacion inválida .';    
$this->Auth->loginRedirect=array('controller'=>'users','action'=>'inicio');    
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
}
?>
