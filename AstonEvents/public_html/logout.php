<?php

//Function to logout and unset session variable - Part of simple login/signup system video referenced in report

session_start();

if(isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
}

header("Location: login.php");
die;
?>