<?php
/* 
 * Hybrid (c)
 * Content Management System 
 */
 
namespace Hybrid\Autoloader;

class Loader 
{
	protected $namespace = '';
	protected $path = '';
	protected $namespaceSeparator = '\\';
	
	private $className;
	
	/**
	 * Maak een instance van de autoloader
	 *
	 * @param string $namespace
	 * @param string $path
	 */
	public function __construct($namespace, $path)
	{
		$this->namespace = ltrim($namespace, $this->namespaceSeparator);
		$this->path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
		
	}
	
	
	/**
	 * Registreer de autoloader naar PHP
	 *
	 * @return boolean
	 */
	 public function register()
	 {
		return spl_autoload_register([$this, 'load']);
	 }
	 
	 
	 /**
	  * Deregistreer de autoloader
	  *
	  * @return boolean
	  */
	 public function unregister()
	 {
		return spl_autoload_unregister([$this, 'load']);
	 }
	 
	 
	 /**
	  * Probeer de class te laden
	  *
	  * @param string $className
	  * @return boolean
	  */
	  public function load($className)
	  {
		// Strip whitespace's weg.
		$this->className = ltrim($className);
		
		if (strpos($this->className, $this->namespace) === 0) {
			$nsparts = explode($this->namespaceSeparator, $this->className);
			$this->className = array_pop($nsparts);
			
			$nsparts[] = '';
			$path = $this->path . implode(DIRECTORY_SEPARATOR, $nsparts);
			$path .= str_replace('_', DIRECTORY_SEPARATOR, $this->className) . '.php';
			
			if(file_exists($path)) {
				require $path;
				
				return true;
			}			
		}	
		
		return false;
	  }
} 