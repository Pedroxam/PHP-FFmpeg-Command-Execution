<?php
/*
* By Pedroxam
*/

if(empty($_POST['code']) or empty($_POST['video']))
	exit('error');

$root   = dirname(__FILE__);

$parameter  = trim($_POST['code']);

$video  = trim($_POST['video']);

$input  = $root . '/input/' . $video;

$output = $root . '/output/' . basename($video);

// ffmpeg path
// eg, for linux "/usr/bin/ffmpeg" and for windows, if you not set environment variables path, you can just enter path of ffmpeg.exe binary
$ffmpeg = 'ffmpeg';

$command = str_ireplace(['ffmpeg', 'INPUT', 'OUTPUT'], [$ffmpeg, $input, $output], $parameter);

$log = $root . '/log.txt';

//validate ffmpeg command
if (strpos($parameter, 'ffmpeg') !== false){
	
	//Start Task
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	{
		pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // windows
	}
	else
	{
		shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //linux
	}

}
