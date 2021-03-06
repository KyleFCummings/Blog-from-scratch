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
        <title>Blog by Kyle Cummings, admin create page</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="StyleMain.css">
        <link rel="shortcut icon" type="image/png" href="pics/montserattSketch.jpg">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="main.js"></script>
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
                    <li><a href="Bio_admin.php">BIO</a></li>
                    <li><a href="https://www.youtube.com" target="_blank">TRAVEL</a></li>
                    <li><a href="BlogCreate.php">CREATE BLOG</a></li>
                    <li id="current-page"><a href="BlogCollection_admin.php">ALL BLOGS</a></li>
                </ul>
            </div>
            
            <div id="login-logout">
                <a href="logout_handler.php">LOGOUT</a>
            </div>
        </div>
        
        <!--
            pull first image from each blog post (title). then have a reference to a page which load the blog they chose according to that title.
        -->
        <div id="collection-holder">
<!--
            <div id="blog-tile">
                <a href="#" id="tile-image">
                    <img src="Sample4_topHeader.jpg">
                    <div id="tile-title">(Test 0; not using php)</div>
                </a>
            </div>
-->
            
            <?php
                $entries = $dao->getAllEntries();  
                foreach ($entries as $title) {
                    $photo = $dao->getFirstImage($title[0]);
                    echo "<div id='blog-tile'><a href='blog_admin.php?id=".$title[0]."' id='tile-image'><img src='".$photo."'><div id='tile-title'>$title[0]</div></a><a href='deleteBlogHandler.php'><img src='pics/crossout.png' id='cross-out'></a></div>";
                }
            ?>
        </div>
        
        <div class="footer">
            <ul>
                <li>Copyright 2016 Blog by Kyle Cummings.</li>
                <li>DEVELOPMENT BY KYLE CUMMINGS.</li>
            </ul>
        </div>
        
    </body>
</html>