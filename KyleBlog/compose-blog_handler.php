<?php
// compose-blog_handler.php
// handles the composing of a new blog, stores the newly created blog in the
// database.

session_start();

require_once "Dao.php";

if (isset($_POST["post-blog"])) {
    
    $title;
    $body;
    //$photo_names;
    
    if(empty($_POST["new-blog-title"])) {
        $_SESSION["new-blog-title-error"] = true;
    }
    else {
        $title = htmlspecialchars($_POST["new-blog-title"]);
        $_SESSION["new-blog-title"] = $title;    //Save blog-title to session global array
    }
    
    if(empty($_POST["new-blog-text"])) {
        $_SESSION["new-blog-text-error"] = true;
    }
    else {
        $body = htmlspecialchars($_POST["new-blog-text"]);
        $_SESSION["new-blog-text"] = $body;    //Save blog-text to session global array
    }

    /*
    *   Grab all the file names and put it into an array from the FILES global array.
    *   Here is where I should probably check if they are .jpeg or .png. Maybe a regex here?
    *   I don't think I need to though because I'm only grabbing the name of the image, not
    *   the image itself.
    */
//    $photo_names = array();
//    for($i=0; $i<count($_FILES['images']['name']); $i++) {
//        if($_FILES['images']['name'][$i]!=null) {
//            $photo_names[$i] = $_FILES['images']['name'][$i];
//        }
//    }
    
    $imageName = "";
    $basePath = "C:/wamp/www/Blogv1WAMP/";
    
    /*
    *   Store title and body into the entries table.
    *   If either are empty, go back to the blog create page and show errors.
    *
    *   Then loop through each image uploaded, check for errors, then upload the
    *   image name into the database corresponding with its blog title. If the admin
    *   doesn't upload any photos, put a null entry so I know that for that blog there
    *   aren't any photos.
    */
    try {
        $dao = new Dao();
        
        if ($title!=null && $body!=null) {
            $dao->insertNewBlog($title, $body);
            //$dao->insertPhotos($title, $photo_names);
            
            //Loop through each photo, check for errors, upload imgName to database
            if (count($_FILES)>0) {
            foreach ($_FILES["images"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $imageName = $_FILES["images"]["name"][$key];
                    if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $basePath . $imageName)){
                        $_SESSION["upload-successful"] = "success";
                        $dao->insertPhoto($title, $imageName);
                    }   
                }
                else if ($error == UPLOAD_ERR_NO_FILE) {
                    throw new RuntimeException('No file sent.');
                }
                else if ($error == UPLOAD_ERR_INI_SIZE) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }
                else if ($error == UPLOAD_ERR_FORM_SIZE) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }
                else {
                    throw new RuntimeException('Unknown errors.');
                }
            }
            }
            else {
                $dao->insertPhoto($title, null);
            }
            
            header("Location:BlogCollection_admin.php");
        }
        else {
            header("Location:BlogCreate.php");
        }
    }
    catch(Exception $e) {
            var_dump($e);
            echo "Something went wrong.";
            die;
    }
    
}

?>