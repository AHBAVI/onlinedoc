<?php
$server = "localhost";
$user = "root";
$psw = "";
$db = "lime";

$con = new mysqli($server,$user,'',$db);

if ($con->connect_error) {
	die("connect error -:".$con->connect_error);
}
?>