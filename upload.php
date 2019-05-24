<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$path = "./input/";
$path = $path . basename($_FILES['file']['name']);
if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
{
	exit($_FILES['file']['name']);
}
else
{
	exit(false);
}