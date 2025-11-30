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
    <title> Aston Events Home </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "js/slideshow.js"> </script>
</head>

<body>

<!-- Header -->
<header>
    <?php
        if ($user_data) {
        echo "Logged in as" . " " . $user_data['user_name'] . " " . "(" . $user_data['email'] . ")"; 
        echo "<a href = logout.php> Logout </a>";
        }
    ?>
</header>

<!-- Logo -->
<div class = "imageRow">
    <img id = "logo" src = "css/images/logo.svg" >
    <img id = "title" src = "css/images/title.png">
</div>


<main>
<!-- Navigation bar -->
<div class = "navigation-bar" >
    <a class = "active" href = "index.php"> Home </a>
    <a href = "sports.php"> Sports </a>
    <a href = "culture.php"> Culture </a>
    <a href = "other.php"> Other Events </a>
    <a href = "login.php"> Login </a>
    <a href = "signup.php"> Signup </a>
</div>

<!-- Reminder to log in or sign up if not logged in already -->
<?php 
    if (!$user_data) {

    echo "<div class = reminder>
    <h2> Login or sign up to register for events! </h2>
    <p> <b> The official home for all ongoing Aston University Events </b> </p>
    </div>";
    }
?>

<!-- General site info -->
<div class = "site-overview" >
    <!-- Slideshow -->
    <img id = "slide" name = "slides" /> 
    <h3> Who are we? </h3>
    <p> We are the Aston Events team responsible for the organisation and advertisement of all events that Aston University has to offer. </p>
    <h3> Why join up? </h3>
    <p> Getting involved with events is a great way to: </p>
    <ul> 
        <li> Build friendships </li>
        <li> Get involved </li>
        <li> Get in shape </li>
        <li> Find new passions </li>
        <li> Add to your CV </li>
        <li> Open up new career paths </li>
    </ul>
</div>

<!-- Footer -->
<div id = "footer">
    <p> &copy 2021 Aston University </p>
</div>

</br>
</br>

</main>
</body>
</html>
