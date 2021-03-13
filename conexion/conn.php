<?php


$databaseHost = 'D5CLQ382';
$databaseName = 'dbdds';
$databaseUsername = 'CBDRCVP';
$databasePassword = 'cbd1*';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die("Connection failed: " . mysqli_connect_error());  
  
echo '12';
?>