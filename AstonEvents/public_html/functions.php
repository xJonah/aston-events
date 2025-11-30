<?php

//Redirect to login page if not signed in - Part of simple login/signup system video referenced in report
function check_login($con) {

	if(isset($_SESSION['user_id'])) {

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: login.php");
	die;

}

//Get user data without redirect
function get_info($con) {
	if(isset($_SESSION['user_id'])) {

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
}

//Get Event data using primary key
function get_event_data($con, $id) {
	
	$query = "select * from events where id = $id";
	$result = mysqli_query($con,$query);
		
	if($result && mysqli_num_rows($result) > 0) {
		$event_data = mysqli_fetch_assoc($result);
		return $event_data;
	}
}

//Get User Events data using email and event name
function get_user_events_data($con, $email, $event) {
	
	$query = "SELECT * FROM user_events WHERE user_email='$email' AND event_attending='$event'";
	$result = mysqli_query($con,$query);
	
	if($result && mysqli_num_rows($result) > 0) {
		$user_events_data = mysqli_fetch_assoc($result);
		return $user_events_data;
	}
}

//Get event likes data using event name
function get_event_likes_data($con, $event) {
	
	$query = "SELECT * FROM event_likes WHERE event_name = '$event'";
	$result = mysqli_query($con,$query);
	
	if($result && mysqli_num_rows($result) > 0) {
		$event_likes_data = mysqli_fetch_assoc($result);
		return $event_likes_data;
	}
}

//Get User likes data using email and event name
function get_user_likes_data($con, $email, $event) {
	
	$query = "SELECT * FROM user_likes WHERE user_email='$email' AND event_liked='$event'";
	$result = mysqli_query($con,$query);
	
	if($result && mysqli_num_rows($result) > 0) {
		$user_likes_data = mysqli_fetch_assoc($result);
		return $user_likes_data;
	}
}

//Create random num of length 10 for user id
function random_num($length) {

	$text = "";

	for ($i=0; $i < $length; $i++) { 
		$text .= rand(0,9);
	}

	return $text;
}


?>