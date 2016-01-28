<?php

/**
 * Display the results of a iPlant job execution
 *
 * Work in progress ...
 *  
 */

$path = $_SERVER['REQUEST_URI'];
$job_id = basename($path);
$resFile = "/tmp/iplant_$job_id/results.txt";

$myfile = fopen($resFile, "r") or die ("<br><p>Unable to access results in file $resFile</p>");
print "Location: /tmp/iplant_$job_id<br>";
while (!feof($myfile)) {
	$line = fgets($myfile);
	print "$line<br>";
}
fclose($myfile);

$host = gethostname();
$ipaddr = gethostbyname($host);

print "<a href=\"http://velarde.ncgr.org:7070/isys/launch?svc=org.ncgr.isys.ncgr.jalview.JalviewAlignmentDisplayService%40http://$ipaddr/sites/default/files/iplant_$job_id/mafft_out.fa\">Launch JalView</a><br>";

print "<a href=\"http://$ipaddr/sites/default/files/iplant_$job_id/mafft_out.fa\">Display File</a><br>\n";

?>

<p>Got Results</p>
