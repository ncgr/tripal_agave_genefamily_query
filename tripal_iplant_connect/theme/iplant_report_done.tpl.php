<?php

/**
 * Display the results of a iPlant job execution
 *
 * Work in progress ...
 *  
 */

$path = $_SERVER['REQUEST_URI'];
$job_id = basename($path);
$resFile = "/tmp/job_$job_id.txt";

$myfile = fopen($resFile, "r") or die ("<br><p>Unable to access results in file $resFile</p>");
while (!feof($myfile)) {
	$line = fgets($myfile);
	print "$line<br>";
}
fclose($myfile);

?>

<p>Got Results</p>
