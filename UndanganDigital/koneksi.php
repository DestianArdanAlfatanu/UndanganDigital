<?php
error_reporting(E_ALL ^ E_NOTICE AND E_DEPRECATED);
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'undangan';

$conn = mysqli_connect($host,$user,$pass,$db);
?>