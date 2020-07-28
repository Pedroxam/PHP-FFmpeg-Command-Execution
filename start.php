<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

if(empty($_POST['code']) or empty($_POST['video']))
	exit('error');

$root   = dirname(__FILE__);

$input  = $root . '/input/' . trim($_POST['video']);

$output = $root . '/output/' . basename($_POST['video']);

$command = str_ireplace(['INPUT', 'OUTPUT'], [$input, $output], trim($_POST['code']));

$log = './log.txt';

//validate ffmpeg command
if (strpos($_POST['code'], 'ffmpeg') !== false){

	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	{
		pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // windows
	}
	else
	{
		shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //linux
	}

}
