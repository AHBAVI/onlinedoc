<?php
$server = "localhost";
$user = "id7703284_ahb";
$psw = "abc1234//";
$db = "id7703284_lime";

$con = new mysqli($server,$user,$psw,$db);

if ($con->connect_error) {
	die("connect error -:".$con->connect_error);
}
?>