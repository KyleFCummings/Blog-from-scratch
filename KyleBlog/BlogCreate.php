<?php

session_start();

//if($_SESSION["logged_in"]!=true) {
//    header("Location:BlogGuestHome.php");
//}
//
//if($_SESSION["permission"]!=1) {
//    header("Location:BlogUserHome.php");
//}

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
                    <li id="current-page"><a href="BlogCreate.php">CREATE BLOG</a></li>
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
            <div id="title-body-form-wrapper">
                
                <p id="edit-title">Compose Blog</p>
                
                <form method="post" class="blog-text-title-form" action="compose-blog_handler.php" enctype="multipart/form-data">
            
                    <?php
                        if(isset($_SESSION["pic-error"])) {
                            echo "<p>Something went fatilly wrong with uploading the pics</p>";
                            unset($_SESSION["pic-error"]);
                        }
                    ?>
                    
                    <p>Insert photos here:</p>
                    <div id="photo-insert">
                        <button id="add-photo-button" type="button" name="another">Add an image.</button>
                    </div>
                    
                    <?php
                        if(isset($_SESSION["new-blog-title-error"])) {
                            echo "<div id='new-blog-error'>Please enter a title</div>";
                            unset($_SESSION["new-blog-title-error"]);
                            unset($_SESSION["new-blog-title"]);
                        }
                    ?>
                    <div class="title-text-wrapper">
                        <input id = "title-text" type="text" name="new-blog-title" placeholder="Enter blog title here." value=
                                "<?php
                                    if(isset($_SESSION["new-blog-title-error"])) {
                                        echo $_SESSION["new-blog-title"]; 
                                    }
                                ?>"/>
                    </div>
                        
                    <?php
                        if(isset($_SESSION["new-blog-text-error"])) {
                            echo "<div id='new-blog-error'>Please enter some text for your blog</div>";
                            unset($_SESSION["new-blog-text-error"]);
                            unset($_SESSION["new-blog-text"]);
                        }
                    ?>
                    <div class="blog-text-wrapper">
                        <textarea id = "blog-text" name="new-blog-text" placeholder="Enter blog text here."><?php 
                            if(isset($_SESSION["new-blog-text-error"])) { 
                                echo $_SESSION["new-blog-text"]; 
                            }?></textarea>
                    </div>
                        
                    <div id="submit-blog-wrapper">
                        <input type="submit" id ="submit-blog" value="Bloggify" name="post-blog">
                    </div>
                    
                </form>      
            </div>
        </div>
        
        
        <div class="footer">
            <ul>
                <li>Copyright 2016 Blog by Kyle Cummings.</li>
                <li>DEVELOPMENT BY KYLE CUMMINGS.</li>
            </ul>
        </div>
    
    </body>
</html>