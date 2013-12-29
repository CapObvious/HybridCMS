<?php
/* 
 * Hybrid (c)
 * Content Management System 
 */
 
namespace Hybrid\Autoloader;

class SessionManager implements \SessionHandlerInterface
{
	public function start()
	{
		echo "SESSION MANAGER STARTED: 0000 ";
	}
}

?>