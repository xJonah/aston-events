<?php

// Connect to database

$dbhost = "localhost:3306";
$dbuser = "u-200089025";
$dbpass = "3im5kkIfgEnMot3";
$dbname = "u_200089025_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

?>