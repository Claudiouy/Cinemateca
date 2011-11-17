<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 
           echo $this->Html->css('miCss');
           echo $this->Html->css('cake.generic');
           echo $this->Html->css('miCss.css');
           echo $this->Html->css('autocompleteui');
           echo $this->Html->css('autoComplete.css');
           echo $this->Html->css('datePicker.css');
           echo $this->Html->css('jquery-ui-1.8.16.custom.css');
           echo $this->Html->charset();
           echo $this->Html->script('jQuery');
           echo $this->Html->script('miJQuery');
           echo $this->Html->script('jquery-1.6.2.min.js');
           echo $this->Html->script('jquery-ui-1.8.16.custom.min.js');
           echo $this->Html->script('date.js');
           echo $this->Html->script('application.js');
           echo $this->Html->script('jquery.datePicker.js');
           echo $this->Html->script('cake.datePicker.js');
        
           ?>   
    
	<title>
		<?php __('Sistema de Gestion de Socios y Puntos de Venta ~ CINEMATECA URUGUAYA'); ?>
		<?php echo $title_for_layout;?>
	</title>

	<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<?php echo $scripts_for_layout;?>
        <style>
            #user-nav{
                width: 100%;
                text-align: right;
                    
            }
        </style>
            
        
</head>
<body>
	<div id="container">
		<div id="header">

			<div id="navbar"> <a href="index.htm" target="_parent">Ingreso a sala</a> · <a href="/cake_primero/socios" target="_parent">Modulo socios</a> · <a href="/cake_primero/peliculas" target="_parent">Modulo peliculas</a> · <a href="/cake_primero/payments" target="_parent">Modulo de pagos</a> · <a href="" target="_parent">Reportes de caja</a> ·  <a href="http://www.cinemateca.org.uy/plus.html" target="_parent">Otros Modulos</a> </div>    


		</div>
		<div id="content">
                        
                    <div id="user-nav">
<?php if ($logged_in):?>
                        Bienvenido <?php echo $users_username;?>&nbsp;-<?php echo $users_userRol;?>-&nbsp;<?php echo $html->link('Cerrar Sesión', array('controller'=>'users','action'=>'logout'));?>
                        <?php else: ?>
    <?php echo $html->link('Registro', array('controller'=>'users','action'=>'add'));?> o 
                        <?php echo $html->link('Login', array('controller'=>'users','action'=>'login'));?>
    <?php endif;?>
                    </div>

	<?php $this->Session->flash();?>

			<?php echo $content_for_layout;?>

		</div>
		<div id="footer">

			<div id="navbar"> <a href="index.htm" target="_parent">Ingreso a sala</a> · <a href="/cake_primero/socios" target="_parent">Modulo socios</a> · <a href="institucional.html" target="_parent">Modulo peliculas</a> · <a href="cinemateca18.html" target="_parent">Modulo de pagos</a> · <a href="festivales.html" target="_parent">Reportes de caja</a> ·  <a href="http://www.cinemateca.org.uy/plus.html" target="_parent">Otros Modulos</a> </div>    

		</div>
	</div>
</body>
</html>