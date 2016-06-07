<?php
// Dao.php

class Dao {

    private $host = "localhost";
    private $db = "blog";
    private $user = "root";
    private $pass = "";
    
    public function getConnection() {
        return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
    }
    
    
    /*
    *   Get the most recent blog title from the database
    */
    public function getMostRecentTitle() {
        $conn = $this->getConnection();
        $qry = "SELECT title FROM entries WHERE entry_id=(SELECT MAX(entry_id) FROM entries)";
        $result = $conn->query($qry);
        
        if($result == false) {
            return "Failed, no blog entries.";
        }
        
        $result=$result->fetch();
        return $result[0];
    }
    
    
    /*
    *   Get the most recent blog text from the database
    */
    public function getMostRecentText() {
        $conn = $this->getConnection();
        $qry = "SELECT blogtext FROM entries WHERE entry_id=(SELECT MAX(entry_id) FROM entries)";
        $result = $conn->query($qry);
        
        if($result == false) {
            return "Failed, no blog entries.";
        }
        
        $result = $result->fetch();
        return $result[0];
    }
    
    
    /*
    *   Gets the most recent picture gallary (filepaths) from the database
    */
    public function getMostRecentPics($title) {
        $conn = $this->getConnection();
        $qry = "SELECT entry_picture_ref FROM picture_collection WHERE blog_title='$title'";
        $result = $conn->query($qry);
        
        if($result==null) {
            return null;
        }
        
        $result = $result->fetchAll(PDO::FETCH_COLUMN,0);
        return $result;
    }
    
    /*
    *   Gets picture gallary (filepaths) from the database for the given blog title
    */
    public function getPics($title) {
        $conn = $this->getConnection();
        $qry = "SELECT entry_picture_ref FROM picture_collection WHERE blog_title='$title'";
        $result = $conn->query($qry);
        
        if($result==null) {
            return null;
        }
        
        $result = $result->fetchAll(PDO::FETCH_COLUMN,0);
        return $result;
    }
    
    
    /*
    *   Gets all entries from the entries tables
    */
    public function getAllEntries() {
        $conn = $this->getConnection();
        $qry = "SELECT title FROM entries";
        $result = $conn->query($qry);
        
        if($result==null) {
            return null;
        }
        return $result;
    }
    
    
    /*
    *   Gets and returns the first image given the title of the blog.
    */
    public function getFirstImage($title) {
        $conn = $this->getConnection();
        $qry = "SELECT entry_picture_ref FROM picture_collection WHERE blog_title='$title'";
        $result = $conn->query($qry);
        
        if($result==null) {
            return null;
        }
        
        $result = $result->fetch();
        return $result[0];
    }
    
    
    /*
    *   Insert the new blog into the database
    */
    public function insertNewBlog($title, $body) {
        $conn = $this->getConnection();
        $qry = "INSERT INTO entries (title, blogtext) VALUES (:title, :body)";
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->execute();
    }
    
    
    /*
    *   Insert photos for the new blog, along with their respective blog title.
    *
    *   If there aren't any photos, it puts null for the respective title.
    */
    public function insertPhotos($title, $photo_names) {
        $conn = $this->getConnection();
        if ($photo_names==null) {
            $qry = "INSERT INTO picture_collection (blog_title) VALUES (:title)";
            $stmt = $conn->prepare($qry);
            $stmt->bindParam(":title", $title);
            $stmt->execute();
        }
        else {
            foreach($photo_names as $photo_name) {
                $qry = "INSERT INTO picture_collection (blog_title, entry_picture_ref) VALUES (:title, :photo_name)";
                $stmt = $conn->prepare($qry);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":photo_name", $photo_name);
                $stmt->execute();
            } 
        }
    }
    
    /*
    *   Insert photos for the new blog, along with their respective blog title.
    *
    *   If there aren't any photos, it puts null for the respective title.
    */
    public function insertPhoto($title, $imgName) {
        $conn = $this->getConnection();
        if ($imgName==null) {
            $qry = "INSERT INTO picture_collection (blog_title) VALUES (:title)";
            $stmt = $conn->prepare($qry);
            $stmt->bindParam(":title", $title);
            $stmt->execute();
        }
        else {
            $qry = "INSERT INTO picture_collection (blog_title, entry_picture_ref) VALUES (:title, :imgName)";
            $stmt = $conn->prepare($qry);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":imgName", $imgName);
            $stmt->execute();
        }
    }
    
    
    /*
    *   Check if the email and password are correct.
    */
    public function checkLogin($email, $password) {
        
        $conn = $this->getConnection();
             
        $qry = "SELECT email FROM users WHERE email= :email";
            
        //Sanatize (prevent SQL injection) using prepare and bindParam
        $result = $conn->prepare($qry);
        $result->bindParam(":email", $email);
        $result->execute();  
        
        if($result==null) {
            return false;
        }
        
        $qry = "SELECT password FROM users WHERE email= :email";
        
        //Sanatize (prevent SQL injection) using prepare and bindParam
        $result = $conn->prepare($qry);
        $result->bindParam(":email", $email);
        $result->execute();
        
        $result = $result->fetch();
        
        return password_verify($password, $result[0]);
        
    }
    
    
    /*
    *   Check the admin permission of the user. Returns 0 or 1
    */
    public function checkAdminPermission($email) {
        $conn = $this->getConnection();
        $qry = "SELECT admin_permission FROM users WHERE email= :email";
        $permission = $conn->prepare($qry);
        $permission->bindParam(":email", $email);
        $permission->execute();
        
        $result = $permission->fetch();
        
        return $result[0];
    }
    
    /*
    *   Check if the email is already in use.
    */
    public function checkForEmail($email) {
        $conn = $this->getConnection();
        $qry = "SELECT email FROM users WHERE email= :email";
            
        //Sanatize (prevent SQL injection) using prepare and bindParam
        $result = $conn->prepare($qry);
        $result->bindParam(":email", $email);
        $result->execute();  
        
        $rows = $result->rowCount(); //Apparently this may not work with select statements?
        
        //If one row has been selected (information matched) return true
        if($rows===1) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    /*
    *   Check if the screen name is already in use.
    */
    public function checkForSN($screenname) {
        $conn = $this->getConnection();
        $qry = "SELECT screenname FROM users WHERE screenname= :screenname";
            
        //Sanatize (prevent SQL injection) using prepare and bindParam
        $result = $conn->prepare($qry);
        $result->bindParam(":screenname", $screenname);
        $result->execute();  
        
        $rows = $result->rowCount(); //Apparently this may not work with select statements?
        
        //If one row has been selected (information matched) return true
        if($rows===1) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    /*
    *   Add the new user into the database.
    */
    public function addUser($email, $screenname, $password) {
        $conn = $this->getConnection();
        $qry = "INSERT INTO users (email, screenname, password) VALUES (:email, :screenname, :password)";
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":screenname", $screenname);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }
    
}

?>