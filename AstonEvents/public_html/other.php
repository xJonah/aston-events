<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
?>

<!-- Setup -->
<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset= "utf-8" />
    <title> Aston Events Other Events </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src ="js/readmore.js"> </script>
    <script src ="js/sort.js"> </script>
</head>

<body>
<!-- Logo -->
<div class = "imageRow">
    <img id = "logo" src = "css/images/logo.svg" >
    <img id = "title" src = "css/images/title.png">
</div>
<!-- Header -->
<header>
    Logged in as <?php echo $user_data['user_name'] . " " . "(" . $user_data['email'] . ")"; ?>
    <a href = "logout.php"> Logout </a>
</header>

<main>
<!-- Navigation bar -->
<div class = "navigation-bar" >
    <a href = "index.php"> Home </a>
    <a href = "sports.php"> Sports </a>
    <a href = "culture.php"> Culture </a>
    <a class = "active" href = "other.php"> Other Events</a>
    <a href = "login.php"> Login </a>
    <a href = "signup.php"> Signup </a>
</div>

<!-- Sort by date --> 
<div class="sort">
    <b> Sort by date: </b>
    <button id = "ascending" onclick="sortDivs('.event1', '.events')"> Ascending </button>
    <button id = "descending" onclick="sortDivs('.event2', '.events')"> Descending </button>
</div>

<!-- Events container -->
<div class = "events"> 
    <!-- Event info -->
    <div class = "event1">
        <div class = "ted"> 
            <img id = "eventImg" src = "css/images/ted.jpg" alt = "TED talk" />
            <h3> TED Talk </h3>
            <ul id = "datalist5">
                <li> Description: Darren Brown delivers another one of his famous TED talks and the topic this time concerns CyberSecurity. </li>
                <li> Date: 01/06/2021 </li>
                <li> Time: 17:00 </li>
                <li> Organiser: Darren Brown (darrenb@aston.ac.uk) </li>
                <li> Venue: Aston School of Engineering lecture theatre 1 </li>
            </ul>
            <span id = "read5"> More details... </span>
        </div>

        <!-- Register button -->
        <div class = "register">
            <form method="post">
                <input id = "registerButton"
                type = "submit"
                value = "Register"
                name = "register5" />  
            </form>
        </div>

        <!-- Post to user_events and print registered message -->
        <div class = "registerMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["register5"])) {

                $id = 5;
                $event_data = get_event_data($con, $id);
                $email = $user_data['email'];
                $event = $event_data['event_name'];
                $user_events = get_user_events_data($con, $email, $event);

                if (!str_contains($email, "@aston.ac.uk")) {
                    echo "You need to be logged into an Aston University Email address to register for events";

                } else if ($user_events == null) {

                    $query = "INSERT INTO user_events (user_email, event_attending) values ('$email', '$event')";
                    mysqli_query($con, $query);
                    echo "You have registered for this event!";
                    
                } else {
                        echo "You have already registered for this event";
                    }
                }
            }

        ?>
        </div>
        
        <!-- Like button -->
        <div class = "like">
            <form method="post">
                <input id = "likeButton"
                type = "submit"
                value = "Like"
                name = "like5" />
            </form>
        </div>

        <!-- Post to tables and print liked message -->
        <div class = "likedMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["like5"])) {

                $id = 5;

                $event_data = get_event_data($con, $id);

                $event = $event_data['event_name'];
                $email = $user_data['email'];
                $event_likes = get_event_likes_data($con, $event);
                $user_likes = get_user_likes_data($con, $email, $event);

                if ($user_likes == null) {
                
                    $query = "UPDATE event_likes SET likes=likes+1 WHERE event_name='$event'";
                    mysqli_query($con, $query);
                    echo "You have liked this event!";

                    $query = "INSERT INTO user_likes (user_email, event_liked) values ('$email', '$event')";
                    mysqli_query($con, $query);

                } else {
                    echo "You have already liked this event!";
                    }
            		$event_likes = get_event_likes_data($con, $event); 
                    echo "</br>";
                    echo "Current likes: " . $event_likes['likes'];
                }
            }

        ?>
        </div>
    </div>
        
    <!-- Event info -->
    <div class = "event2">
        <div class = "rave"> 
            <img id = "eventImg" src = "css/images/rave.jpg" alt = "Electro Rave" />
            <h3> EDM Rave </h3>
            <ul id = "datalist6">
                <li> Description: Join Aston's first post-covid rave with all your favourite EDM music genres including: Techno, trap, house, and DNB. The location of the rave will be sent to you via email upon purchase of a ticket.  </li>
                <li> Date: 10/06/2021 </li>
                <li> Time: 21:00 </li>
                <li> Organiser: Rave Society (ravesoc@aston.ac.uk) </li>
                <li> Venue: *Secret* </li>
            </ul>
            <span id = "read6"> More details... </span>
        </div>
        
        <!-- Register button -->
        <div class = "register">
            <form method="post">
                <input id = "registerButton"
                type = "submit"
                value = "Register"
                name = "register6" />  
            </form>
        </div>

        <!-- Post to user_events and print registered message -->
        <div class = "registerMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["register6"])) {

                $id = 6;
                $event_data = get_event_data($con, $id);
                $email = $user_data['email'];
                $event = $event_data['event_name'];
                $user_events = get_user_events_data($con, $email, $event);

                if (!str_contains($email, "@aston.ac.uk")) {
                    echo "You need to be logged into an Aston University Email address to register for events";

                } else if ($user_events == null) {

                    $query = "INSERT INTO user_events (user_email, event_attending) values ('$email', '$event')";
                    mysqli_query($con, $query);
                    echo "You have registered for this event!";
                
                } else {
                        echo "You have already registered for this event";
                    }
                    echo '<script type="text/javascript">',
                	'sortDivs(\'.event2\', \'.events\');',
                	'</script>';
                }
            }

        ?>
        </div>

        <!-- Like button -->
        <div class = "like">
            <form method="post">
                <input id = "likeButton"
                type = "submit"
                value = "Like"
                name = "like6" />
            </form>
        </div>
        
        <!-- Post to tables and print liked message -->
        <div class = "likedMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["like6"])) {

                $id = 6;

                $event_data = get_event_data($con, $id);

                $event = $event_data['event_name'];
                $email = $user_data['email'];
                $event_likes = get_event_likes_data($con, $event);
                $user_likes = get_user_likes_data($con, $email, $event);

                if ($user_likes == null) {
                
                    $query = "UPDATE event_likes SET likes=likes+1 WHERE event_name='$event'";
                    mysqli_query($con, $query);
                    echo "You have liked this event!";

                    $query = "INSERT INTO user_likes (user_email, event_liked) values ('$email', '$event')";
                    mysqli_query($con, $query);

                } else {
                    echo "You have already liked this event!";
                }
            	$event_likes = get_event_likes_data($con, $event); 
                echo "</br>";
                echo "Current likes: " . $event_likes['likes'];
                echo '<script type="text/javascript">',
                'sortDivs(\'.event2\', \'.events\');',
                '</script>';
            }
        }

        ?>
        </div>
    </div>
</div>

<!-- Footer -->
<div id = "footer">
    <p> &copy 2021 Aston University </p>
</div>

</main>
</body>
</html>