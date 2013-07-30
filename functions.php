<?php

//Common functions

function writeLog($message) {
	//store it near index.php - it is NOT fucking secure, but development-simple :))
	$path = $_SERVER['DOCUMENT_ROOT'];
	
	$r = @fopen($path.'/logfile.txt', 'a+');
	$m = date("Y-m-d H:i:s") . " :: ".$message."\n";
	
	if($r) {
		$w = @fwrite($r, $m);
		if ($w) {
			@fclose($r);
		} else {
			print $m;
		}
	} else {
		print $m;
	}

}