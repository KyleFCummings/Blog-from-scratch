<?php
// login_handler.php
// handles the login post, checking with the database, and redirecting back to either
// the login page, the user page, or the admin page.
session_start();

require_once "Dao.php";

    if (isset($_POST["LoginButton"])) {
        
        $email;
        $password;
        
        if(empty($_POST["Email"])) {
            $_SESSION["email"] = null;
            $status = "Please enter an email.";
            $_SESSION["email_pass_error"] = $status;
            header("Location:BlogLogin.php");
        }
        else {
            $email = htmlspecialchars($_POST["Email"]);
            $_SESSION["email"] = $email;    //Save email to session global array
        }
        if(empty($_POST["Password"])) {
            $_SESSION["password"] = null;
            $status = "Please enter a password.";
            $_SESSION["email_pass_error"] = $status;
            header("Location:BlogLogin.php");
        }
        else {
            $password = htmlspecialchars($_POST["Password"]);
        }
        
        //Check user's login credentials, then their permission.
        try{
            
            $dao = new Dao();
            $result = $dao->checkLogin($email,$password);
            
            if ($result===FALSE) {
                $status = "Invalid email or password.";
                $_SESSION["email_pass_error"] = $status;
                header("Location:BlogLogin.php");
            }
            else {
                
                if($_SESSION["email_pass_error"]==null) {
                    $permission = $dao->checkAdminPermission($email);
                    
                    if($permission==0) {
                        header("Location:BlogHome.php");
                        $_SESSION["permission"] = 0;
                        $_SESSION["logged_in"] = true;
                    }
                    else {
                        header("Location:BlogAdminHome.php");
                        $_SESSION["permission"] = 1;
                        $_SESSION["logged_in"] = true;
                    }
                }
                
            }
        }
        catch(Exception $e) {
            var_dump($e);
            echo "Something went wrong.";
            die;
        }
    }
?>