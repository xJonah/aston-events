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
    <title> Aston Events Sports </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <a class = "active" href = "sports.php"> Sports </a>
    <a href = "culture.php"> Culture </a>
    <a href = "other.php"> Other Events </a>
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
        <div class = "rugby"> 
            <img id = "eventImg" src = "css/images/rugby.jpg" alt = "Aston Rugby Team" />
            <h3> Rugby Chaos Match </h3>
            <ul id = "datalist1">
                <li> Description: Players split into two teams with no substitutions and no player cap. Good luck and be careful. All players of the winning team get tickets to the next Rugby six nations game.  </li>
                <li> Date: 15/05/2021 </li>
                <li> Time: 14:00 </li>
                <li> Organiser: Rory Chad (roryc@aston.ac.uk) </li>
                <li> Venue: Aston University Rugby Field </li>
            </ul>
            <span id = "read1"> More details... </span>
        </div>

        <!-- Register button -->
        <div class = "register">
            <form method="post">
                <input id = "registerButton"
                type = "submit"
                value = "Register"
                name = "register1" />  
            </form>
        </div>

        <!-- Post to user_events and print registered message -->
        <div class = "registerMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["register1"])) {

                $id = 1;
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
                name = "like1" />
            </form>
        </div>

        <!-- Post to tables and print liked message -->
        <div class = "likedMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["like1"])) {

                $id = 1;

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
        <div class = "football"> 
            <img id = "eventImg" src = "css/images/football.jpg" alt = "Aston Football Team" />
            <h3> Football 5v5 Tournament </h3>
            <ul id = "datalist2">
                <li> Description: An elimination-bracket 5v5 tournament free for anyone and their team to enter. Take home a generous cash prize if you become the champions. </li>
                <li> Date: 21/05/2021 </li>
                <li> Time: 18:00 </li>
                <li> Organiser: Harry Cunnings (harryc@aston.ac.uk) </li>
                <li> Venue: Aston University Football hardcourt </li>
            </ul>
            <span id = "read2"> More details... </span>  
        </div>
        
        <!-- Register button -->
        <div class = "register">
            <form method="post">
                <input id = "registerButton"
                type = "submit"
                value = "Register"
                name = "register2" />  
            </form>
        </div>
        
        <!-- Post to user_events and print registered message -->
        <div class = "registerMsg">
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(isset($_POST["register2"])) {

                $id = 2;
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
                name = "like2" />
            </form>
        </div>

            <!-- Post to tables and print liked message -->
            <div class = "likedMsg">
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(isset($_POST["like2"])) {

                    $id = 2;

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