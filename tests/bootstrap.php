<?php
//Ini settings
ini_set('display_startup_errors', true);
ini_set('display_errors', true);

//ZF2 Autoloader
chdir(dirname(__DIR__));
//require_once ('c:/WebDev/Libraries/ZF2/v2.0.0beta3-145-gffc97f8/library/Zend/Loader/AutoloaderFactory.php');
Zend\Loader\AutoloaderFactory::factory();