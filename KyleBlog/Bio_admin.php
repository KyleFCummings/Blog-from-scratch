<?php

session_start();

//if($_SESSION["logged_in"]!=true) {
//    header("Location:BlogHome.php");
//}
//
//if($_SESSION["permission"]!=1) {
//    header("Location:BlogHome.php");
//}

 require_once "Dao.php";
    $dao = new Dao();

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- what browser this should run in, probably should put this here? -->
        <title>Blog by Kyle Cummings, admin home page.</title>
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
                    <li><a href="BlogAdminHome.php">HOME</a></li> 
                    <li id="current-page"><a href="Bio_admin.php">BIO</a></li>
                    <li><a href="https://www.youtube.com" target="_blank">TRAVEL</a></li>
                    <li><a href="BlogCreate.php">CREATE BLOG</a></li>
                    <li><a href="BlogCollection_admin.php">ALL BLOGS</a></li>
                </ul>
            </div>
            
            <div id="login-logout">
                <a href="logout_handler.php">LOGOUT</a>
            </div>
        </div>
        
        <div class="bio-content">
            <p>Hi all! Welcome to my blog page.</p>
            <p>Edit bio below.</p>
            <p>Textarea to edit bio.</p>
        </div>        
    
        <div class="footer">
            <ul>
                <li>Copyright 2016 Blog by Kyle Cummings.</li>
                <li>DEVELOPMENT BY KYLE CUMMINGS.</li>
            </ul>
        </div>
        
    </body>
</html>