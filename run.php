<?php 

require_once 'core/init.php';

if (isset($argv[1])) {
    $name = $argv[1];
}else{
	fwrite(STDOUT, "Make sure you give an argument, like php run.php products.csv \n");
	die();
}

$log = new Log();

$cvs = new Import($name);

$cvs->get_rows($rows);

$log->write(print_r($rows, true),'-dataOutput-');
fwrite(STDOUT, "check the error logs within the classes folder for errors \n");




