<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$getContent = file_get_contents('./log.txt');

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

if($progress > 98)
{
	$results = 'done';
}
elseif(strpos($getContent, 'Qavg') !== false)
{
	$results = 'done';
}
elseif(strpos($getContent, 'kb/s:') !== false)
{
	$results = 'done';
}
else
{
	$results = $progress;
}

exit(json_encode([ 'progress' => $results, 'log' => $getContent ]));