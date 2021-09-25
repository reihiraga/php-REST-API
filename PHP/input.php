<?php
	include 'connect.php';
	$temperature=$_GET['temp'];
	date_default_timezone_set("Asia/Jakarta");
	$mydate=date("Y-n-j"); //years-month-day
	$mytime=date("H:i:s"); //hours:minutes:second 
	$query="Insert into data (temperature,date, time) values 
	('$temperature','$mydate','$mytime')"; 
	$proses=mysqli_query($connect,$query); 
	if($proses)
		echo "Success"; 
	else
		echo "Failed Uploaded";
?>