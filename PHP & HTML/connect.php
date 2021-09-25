<?php 
	$host ="localhost"; //database hostname
	$user ="root"; //database User ID
	$pass =""; //database password
	$database ="iot_ts";//database name
	$connect=mysqli_connect($host,$user,$pass,$database) or die 
	("Connection Failed"); 
?>