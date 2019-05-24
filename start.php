<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$root = dirname(__FILE__) . '/';

$input  = $root . '/input/' . $_POST['video'];

$output = $root . '/output/' . basename($input);

$command = str_ireplace(['INPUT','OUTPUT'], [$input,$output], trim($_POST['code']));

$log = './log.txt';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
	pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // windows
}
else
{
	shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //linux
}