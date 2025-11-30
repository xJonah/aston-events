<?php 
session_start();
include("connection.php");
include("functions.php");
$user_data = get_info($con);
?>

<!-- Setup -->
<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset= "utf-8" />
    <title> Aston Events Sign Up Page </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class = "signup">
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
    <a href = "login.php"> Login </a>
    <a class = "active" href = "signup.php"> Signup </a>
</div>

<!-- Sign up form -->
<div id="signup-box">
    <form method="post">
        <h1> Signup </h1>
        <input id = "text" 
        type = "text" 
        name = "name"
        placeholder = "Full name" 
        required pattern = "([A-z\s]){5,}"
        oninvalid="this.setCustomValidity('Name can not contain special characters or numericals')"
        oninput ="setCustomValidity('')"
        title = "Please enter your full name" />
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
        <input id = "text" 
        type = "password" 
        name = "password2"
        placeholder = "Confirm Password" 
        required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
        oninvalid="this.setCustomValidity('Password must contain 8 characters including an uppercase, lowercase and a number')"
        oninput ="setCustomValidity('')"
        title = "Please re-enter your password" />  
        <input id="button" 
        type="submit" 
        value="Signup"><br><br>
    </form>
    <a href = "login.php"> Already have an account? </a>
    </br>

    <!-- Function to post user info to database and validate passwords - Part of simple login/signup system video referenced in report -->
   <div class = "signupMsg">
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $user_name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if(!empty($user_name) && !empty($email) && !empty($password) && !empty($password2)) {

        //Validation
    
            if(!is_numeric($user_name) && $password === $password2) {

            //Save to database
            $user_id = random_num(10);
            $query = "insert into users (user_id,user_name,email,hashed_password) values ('$user_id','$user_name','$email', '$hashed_password')";
            mysqli_query($con, $query);

            //Redirect to login page
            header("Location: login.php");
            die;

            } else {
                echo "Passwords are not identical";
            }
            
        } else {
            echo "Please fill in all fields";
        }
    }
?>
    </div>
</div>

<!-- Footer -->
<div id = "footer">
    <p> &copy 2021 Aston University </p>
</div>



</main>
</body>
</html>


