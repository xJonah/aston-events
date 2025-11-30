<?php 
session_start();
include("connection.php");
include("functions.php");
$user_data = get_info($con);

//Function to fetch user info and create session variable - Part of simple login/signup system video referenced in report

if($_SERVER['REQUEST_METHOD'] == "POST") {
	
    $email = $_POST['email'];
	$password = $_POST['password'];

	if(!empty($email) && !empty($password)) {

        //Read from database
		$query = "select * from users where email = '$email' limit 1";
		$result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) > 0) {
        
            $user_data = mysqli_fetch_assoc($result);
            $hashed_password = $user_data['hashed_password'];

            //Create session and edirect to home page once logged in
			if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
                }
            }
                  
		} else {
			echo "Wrong email or password";
		}
	}
?>

<!-- Setup -->
<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset= "utf-8" />
    <title> Aston Events Login page </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class = "login">
<!-- Logo -->
<div class = "imageRow">
    <img id = "logo" src = "css/images/logo.svg" >
    <img id = "title" src = "css/images/title.png">
</div>
<!-- Header -->
<header>
    <?php
    if ($user_data) {
         echo "Already logged in as" . " " . $user_data['user_name'] . " " . "(" . $user_data['email'] . ")"; 
        echo "<a href = logout.php> Logout </a>";
    }
    ?>
</header>

<main>
<!-- Navigation bar -->
<div class = "navigation-bar" >
    <a href = "index.php"> Home </a>
    <a href = "sports.php"> Sports </a>
    <a href = "culture.php"> Culture </a>
    <a href = "other.php"> Other Events </a>
    <a class = "active" href = "login.php"> Login </a>
    <a href = "signup.php"> Signup </a>
</div>

<!-- Log in form -->
<div id="login-box">
    <form method="post">
        <h1> Login </h1>
        <input id = "text" 
        type = "email" 
        name = "email"
        placeholder = "Email" 
        required 
        title = "Please enter an email address" />
        <input id = "text" 
        type = "password" 
        name = "password"
        placeholder = "Password" 
        required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        oninvalid="this.setCustomValidity('Password must contain 8 characters including an uppercase, lowercase and a number')"
        oninput ="setCustomValidity('')"
        title = "Please enter your password" />
        <input id="button" 
        type="submit" 
        value="Login"><br><br>
    </form>
    <a href = "signup.php"> Don't have an account? </a>
</div>

<!-- Footer -->
<section id = "footer">
    <p> &copy 2021 Aston University </p>
</section>

</main>
</body>
</html>

