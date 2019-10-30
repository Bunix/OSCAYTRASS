<?php 
include('../config/config.php');
require "../config/pass.php";
?>
<?php

if(isset($_POST["submit"]))
{

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
header("refresh:0; url=../");
}
 $uname = mysqli_real_escape_string($db, $_POST["uname"]);
 $pass = mysqli_real_escape_string($db, $_POST["pass"]);
 $pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
 $fname = mysqli_real_escape_string($db, $_POST["fname"]);
 $typeid = mysqli_real_escape_string($db, 3);
 
 $encrypt_pass = md5($pass2.$salt);
 $encrypt_unames = md5($uname.$salt);
 $encrypt_name = base64_encode($fname);
 

if ($pass2<>$pass) {
    echo "<script type= 'text/javascript'>alert('The password you have entered is not the same!');</script>";
    header("refresh:0; url=add_member_user.php");
 }
 else {
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO user (type_id, username, password, fullname) VALUES (?,?,?,?)");
    $stmt->bind_param("isss", $typeid, $encrypt_unames, $encrypt_pass, $encrypt_name);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=add_member_user.php");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
  }  
 
}

 
}
?>