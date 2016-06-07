<?php
// signup_handler.php
// handles the login post, checking with the database, and redirecting back to either
// the login page, the user page, or the admin page.
session_start();

require_once "Dao.php";

    if (isset($_POST["LoginButton"])) {
        
        $newEmail;
        $screenname;
        $newPassword;
        
        //Check new email
        if(empty($_POST["newEmail"])) {
            $_SESSION["newEmail"] = null;
            $status = "Please enter an email.";
            $_SESSION["email_pass_SN_error"] = $status;
            header("Location:BlogCreateUser.php");
        }
        else {
            $newEmail = htmlspecialchars($_POST["newEmail"]);
            if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $newEmail)) {
                $status = "Please enter a valid email.";
                $_SESSION["email_pass_SN_error"] = $status;
                header("Location:BlogCreateUser.php");
            }
            
            $_SESSION["newEmail"] = $newEmail;    //Save email to session global array
        }
        
        //Check screenname
        if(empty($_POST["screenname"])) {
            $_SESSION["screenname"] = null;
            $status = "Please enter a screen name.";
            $_SESSION["email_pass_SN_error"] = $status;
            header("Location:BlogCreateUser.php");
        }
        else {
            $screenname = htmlspecialchars($_POST["screenname"]);
            $_SESSION["screenname"] = $screenname;    //Save screenname to session global array
        }
        
        //Check password
        if(empty($_POST["newPassword"])) {
            $status = "Please enter a password.";
            $_SESSION["email_pass_SN_error"] = $status;
            header("Location:BlogCreateUser.php");
        }
        else {
            $newPassword = htmlspecialchars($_POST["newPassword"]);
            $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
        }
        
        //Check if email and screenname are in use. Add new user to database if they aren't.
        try{
            $dao = new Dao();
            $isEmailInUse = $dao->checkForEmail($newEmail);
            if ($isEmailInUse==true) {
                $status = "Email already in use.";
                $_SESSION["email_pass_SN_error"] = $status;
                header("Location:BlogCreateUser.php");
            }
            
            $isScreenNameInUse = $dao->checkForSN($screenname);
            if ($isScreenNameInUse==true) {
                $status = "ScreenName already in use.";
                $_SESSION["email_pass_SN_error"] = $status;
                header("Location:BlogCreateUser.php");
            }
            
            if($_SESSION["email_pass_SN_error"]==null) {
                $dao->addUser($newEmail, $screenname, $newPasswordHashed);
                $_SESSION["logged_in"]=true;
                header("Location:BlogHome.php");
            }
               
        }
        catch(Exception $e) {
            var_dump($e);
            echo "Something went wrong.";
            die;
        }
    }
?>