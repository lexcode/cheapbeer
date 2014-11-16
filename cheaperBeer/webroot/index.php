<?php

session_start();
//ob_start();
define('WEBROOT',dirname(__FILE__)); 
define('ROOT',dirname(WEBROOT)); 
define('DS',DIRECTORY_SEPARATOR);
define('LIB',ROOT.DS.'lib');
define('CACHE',ROOT.DS.'cache');
define('CORE',ROOT.DS.'core'); 
define('CONF',ROOT.DS.'config'.DS); 
define('TRAN',ROOT.DS.'view'.DS.'translates'.DS);
define('LANG',ROOT.DS.'language'.DS); 
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME']))); 

require CORE.DS.'includes.php'; 
new Dispatcher(); 


?>
