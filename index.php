<?php
/* 
 * Hybrid (c)
 * Content Management System 
 */

 use Hybrid\Storage\MysqlFactory;
 
 require 'src/Hybrid/autoloader/Loader.php';
 
 try {
	// Laad autoloader
	$autoloader = new Hybrid\Autoloader\Loader('Hybrid', 'src');
	$autoloader->register();
	
	// Laad de dependency injection class.
	$di = new Hybrid\Component\DI();
	
	$di->set('db', function (){
		return new MysqlFactory();
	}); 
	
	$di->set('session', function ($config) {
		$config = new SessionHandler();
		$config->start();
	
	});

 } catch (Exception $ex) {
	echo $ex->getMessage();
 }
 
 
 ?>