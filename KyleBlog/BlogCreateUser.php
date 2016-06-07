<?php
//BlogCreateUser.php

session_start();


?>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <!-- what browser this should run in, probably should put this here? -->
        <title>Sign up: Blog by Kyle Cummings</title>
        <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="StyleMain.css">
        <link rel="shortcut icon" type="image/png" href="pics/montserattSketch.jpg">
    </head>
    
    <body class="login-background">
           
        <div>
            <h1 id="blog-title">KYLE CUMMINGS</h1>
        </div>
        
        <div class="login-body">
            <form method="post" class="login-center-form" action="signup_handler.php">
                
                <div>
                    <h1 id="login-header">Welcome New User!</h1>
                </div>
               
                <?php 
                    if(isset($_SESSION["email_pass_SN_error"])) {
                        echo "<div id='error_message'>" . $_SESSION["email_pass_SN_error"] . "</div>";
                        unset($_SESSION["email_pass_SN_error"]);
                    }
                ?>
                
                <div class="username-pass-container">
                    
                    <input id="name-field" type="text" name="newEmail" placeholder="Email" value=
                        "<?php 
                            if(isset($_SESSION["newEmail"])) 
                                echo $_SESSION["newEmail"];
                                unset($_SESSION["newEmail"]);
                        ?>"/>
                    <input id="name-field" type="text" name="screenname" placeholder="Screen Name" value=
                        "<?php 
                            if(isset($_SESSION["screenname"])) 
                                echo $_SESSION["screenname"];
                                unset($_SESSION["screenname"]);
                        ?>"/>
                    
                    <input id="password-field" type="password" name="newPassword" placeholder="Password"/>
                    
                </div>
                
                <div id="signin-button-wrapper">
                    <input type="submit" value="Log in" name="LoginButton">
                </div>
                
                <div id="guest-continue">
                    <a href="BlogHome.php">Continue as guest</a>
                </div>
                
            </form>
        </div>
        
    </body>
</html>