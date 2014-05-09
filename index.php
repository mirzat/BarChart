<?php

// Report all errors
ERROR_REPORTING(E_ALL);
const INPUT_DEFAULT = 'please enter a note';

// Include all the classes
function __autoload($className){
	$filename = 'class.'.$className.'.php';
	if (is_readable($filename)) 
        require $filename;
}

// Create a new instance of Calendar (Controller)
$calendar = new Calendar();

?>