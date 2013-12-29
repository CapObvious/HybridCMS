<?php
/* 
 * Hybrid (c)
 * Content Management System 
 */

 namespace Hybrid\Component;
 
 /**
  * Dependency Injection class
  * @package Hybrid\Component
  */
	 	 
 class DI
 {
	protected $values = array();
	protected $services = array();
	protected $instance = array();
	
	
	/**
	 * Maak een nieuwe service
	 *
	 * @param mixed $key
	 * @param mixed|closure $value
	 */
	public function set($key, $value, $services = false)
	{
		$this->values[$key] = $value;
		$this->services[$key] = $services;
	}
	
	
	/**
	 * Haal een service op
	 *
	 * @param mixed $key 
	 */
	 public function get($key)
	 {
		// Kijk of de service weldegelijk bestaat, zo niet, stuur exception
		if(!isset($this->values[$key])) {
			// Bestaat niet, stuur foutmelding.
			throw new \InvalidArgumentException(sprintf(
				"Er is geen service aangemaakt voor de service %s",
				$key
			));
		}
		
		
		if(is_callable($this->values[$key])) {
			if($this->services[$key] && isset($this->instance[$key])) {
				return $this->instance[$key];
			}
			
			$instance = $this->values[$key]($this);
			
			if ($this->services[$key]) {	
				return $this->instance[$key];
			}
			
			return $this->values[$key];
			
			
		}
		
	 }
 }