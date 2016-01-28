<?php

/**
 * Template to keep the user updated on the progress of their iPlant Request
 *
 * Available Variables:
 *  - $status_code: a numerical code describing the status of the job. See the table
 *    below for possible values.
 *  - $status: a string describing the status of the job. See the table below for
 *    possible values
 *
 *    CODE          STATUS                DESCRIPTION
 *     0             Pending               The tripal job has been created but has not yet been launched.
 *     1             Running               The Tripal job is currently running.
 *    999            Cancelled             The Tripal job was cancelled by an administrator.
 */
?>

<script>
Drupal.behaviors.blastuiSetTimeout = {
  attach: function (context, settings) {
    setTimeout(function(){
       window.location.reload(1);
    }, 5000);
  }
};

</script>

<?php
  // JOB IN QUEUE
  if ($status_code === 0) {
    drupal_set_title('iPlant Job in Queue');
?>

  <p>Your iPlant has been registered and will be started shortly. This page will automatically refresh.</p>

<?php
  }
  // JOB IN PROGRESS
  elseif ($status_code === 1) {
    drupal_set_title('iPlant Job in Progress');
?>

  <p>Your iPlant job is currently running. The results will be listed here as soon as it completes. This page will automatically refresh.</p>

<?php
$path = $_SERVER['REQUEST_URI'];
$job_id = basename($path);
$resFile = "/tmp/iplant_$job_id/err.log";
$lineFile = "/tmp/iplant_$job_id/line_number.txt";

$myfile = fopen($resFile, "r") or die ("<br><p>Unable to access results in file $resFile</p>");
while (!feof($myfile)) {
	$line = fgets($myfile);
	$splitLine = explode(":", $line);
	if ($splitLine[0] == "MESSAGE") {
		$lastLine = $line;
	}
}
fclose($myfile);

$splitLine = explode(":", $lastLine);
print ("<p><h2>Process: $splitLine[1]</h2><h2>Status: $splitLine[2]</h2>");

  }
  // JOB CANCELLED
  elseif ($status_code === 999) {
    drupal_set_title('iPlant Job Cancelled');

$path = $_SERVER['REQUEST_URI'];
$job_id = basename($path);
$resFile = "/tmp/iplant_$job_id/err.log";

$myfile = fopen($resFile, "r") or die ("<br><p>Unable to access results in file $resFile</p>");
print "Location: /tmp/iplant_$job_id<br>";
while (!feof($myfile)) {
	$line = fgets($myfile);
	print "$line<br>";
}
fclose($myfile);
?>

  <p>Unfortunately your iPlant job has been cancelled by an Administrator.  This page will automatically refresh.</p>

<?php
 }
?>
