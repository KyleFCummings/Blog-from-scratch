<?php

    session_start();

    if($_SESSION["logged_in"]!=true) {
        header("Location:BlogHome.php");
    }

    if($_SESSION["permission"]!=1) {
        header("Location:BlogHome.php");
    }

    require_once "Dao.php";
    $dao = new Dao();

    $title = $_GET["id"];

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- what browser this should run in, probably should put this here? -->
        <title>Blog by Kyle Cummings</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="StyleMain.css">
        <link rel="shortcut icon" type="image/png" href="pics/montserattSketch.jpg">
    </head>
    
    <body>
        
        <div id="pic-table">
            <div id="table-cell">
                <img src="Sample1_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample2_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample3_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample4_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample5_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample6_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample7_topHeader.jpg" id= "header-pic">
            </div>
            <div id="table-cell">
                <img src="Sample8_topHeader.jpg" id= "header-pic">
            </div>
        </div>
        
        <div id="nav-menu">
            <div id="center-menu-wrapper">
                <ul>
                    <li><a href="BlogAdminHome.php">HOME</a></li> 
                    <li><a href="Bio_admin.php">BIO</a></li>
                    <li><a href="https://www.youtube.com" target="_blank">TRAVEL</a></li>
                    <li><a href="BlogCreate.php">CREATE BLOG</a></li>
                    <li><a href="BlogCollection_admin.php">ALL BLOGS</a></li>
                </ul>
               
            </div>
                      
            <div id="login-logout">
                <a href="logout_handler.php">LOGOUT</a>
            </div>
            
        </div>
        
        <div>
            <h1 id="blog-title">KYLE CUMMINGS</h1>
        </div>
        
        
        <div class="content">
            <article class="top-post">
                <header id="top-post-header">
                    <?php
                        echo $title;
                    ?>
                </header>
                
                <div id="top-post-pics-wrapper">
                <?php
                    //Retrieve photos for the most recent blog and loop through each and display them.
                    $pics = $dao->getPics($title);
                    if ($pics!=null) {
                        foreach($pics as $source) {
                            echo "<img id='top-post-pics' src='$source'>";
                        }
                    }
                ?>
                </div>
                
                <p class="blog-post-text">
                    <?php
                        echo nl2br($dao->getMostRecentText()); //This will make paragraphs when a new line character is hit.
                    ?>
                </p>
            </article>
        </div>
        
        
        <div class="footer">
            <ul>
                <li>Copyright 2016 Blog by Kyle Cummings.</li>
                <li>DEVELOPMENT BY KYLE CUMMINGS.</li>
            </ul>
        </div>
    
    </body>
</html>