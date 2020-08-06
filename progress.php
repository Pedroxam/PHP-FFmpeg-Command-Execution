<?php
/*
* By Pedroxam
*/

// If the log can't be displayed in the index, change $root value to: dirname(__FILE__)
$root = '.';

$getContent = file_get_contents($root . '/log.txt');
preg_match("/Duration: (.*?), start:/ms", $getContent, $matches);
if(!empty($rawDuration = $matches[1]))
$ar = array_reverse(explode(":", $rawDuration));
$duration = floatval($ar[0]);
if (!empty($ar[1])) $duration += intval($ar[1]) * 60;
if (!empty($ar[2])) $duration += intval($ar[2]) * 60 * 60;
preg_match_all("/time=(.*?) bitrate/", $getContent, $matches);
$rawTime = array_pop($matches);
if (is_array($rawTime)){$rawTime = array_pop($rawTime);}
$ar = array_reverse(explode(":", $rawTime));
$time = floatval($ar[0]);
if (!empty($ar[1])) $time += intval($ar[1]) * 60;
if (!empty($ar[2])) $time += intval($ar[2]) * 60 * 60;

//progress prec..
$progress = round(($time/$duration) * 100);

if(	
	$progress > 98 or
	strpos($getContent, 'Qavg') !== false or
	strpos($getContent, 'kb/s:') !== false
){
	$results = 'done';
}
else {
	$results = $progress;
}

exit(json_encode([ 'progress' => $results, 'log' => $getContent ]));
