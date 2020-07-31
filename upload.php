<?php
/*
* By Pedram
* Email: pedroxam@gmail.com
*/

$root = '.'; // Change to dirname(__FILE__) if an error occurs.
 
$dir  = $root . "/input/";

$path = $dir . str_replace(' ', '_', basename($_FILES['file']['name']));

if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
{
	exit($_FILES['file']['name']);
}
else
{
	exit(false);
}
