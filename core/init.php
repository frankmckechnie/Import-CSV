<?php 

// uses the config class to sort what needs to be used within the application
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root', // username 
        'password' => '',	  // password
        'db' => 'application' // database name
    )
);

// will auto load any calls that is within the classes folder
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});