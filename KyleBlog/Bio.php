<?php

    session_start();

    require_once "Dao.php";
    $dao = new Dao();

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- what browser this should run in, probably should put this here? -->
        <title>Bio of Kyle Cummings</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="StyleMain.css">
        <link rel="shortcut icon" type="image/png" href="pics/montserattSketch.jpg">
    </head>
    
    <body>
        
        <div id="pic-table">
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="pics/milkywayOverSecondBeach.jpg" id= "header-pic">
            </div>
        </div>
        
        <div id="nav-menu">
            <div id="center-menu-wrapper">
                <ul>
                    <li><a href="BlogHome.php">HOME</a></li> 
                    <li id="current-page"><a href="Bio.php">BIO</a></li>
                    <li><a href="https://www.youtube.com" target="_blank">TRAVEL</a></li>
                    <li><a href="BlogCollection.php">BLOGS</a></li>
                </ul>
            </div>
            
            <div id="login-logout">
                <?php
                if(isset($_SESSION["logged_in"])) {
                    echo "<a href='logout_handler.php'>LOGOUT</a>";
                }
                else {
                    echo "<a href='BlogLogin.php'>LOGIN</a>";
                }
                ?>
            </div>
        </div>
        
        <div>
            <h1 id="blog-title">KYLE CUMMINGS</h1>
        </div>
        
        
        <div class="bio-content">
            <p>Hi all! Welcome to my blog page. </p>
        </div>
        
        
        <div class="footer">
            <ul>
                <li>Copyright 2016 Blog by Kyle Cummings.</li>
                <li>DEVELOPMENT BY KYLE CUMMINGS.</li>
            </ul>
        </div>
    
    </body>
</html>