<?php 
include('../config/config.php');
require "../config/pass.php";
?>
<?php

if(isset($_POST["submit"]))
{

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
header("refresh:0; url=admin");
}
 $uname = mysqli_real_escape_string($db, $_POST["uname"]);
 $pass = mysqli_real_escape_string($db, $_POST["pass"]);
 $pass2 = mysqli_real_escape_string($db, $_POST["pass2"]);
 $fname = mysqli_real_escape_string($db, $_POST["fname"]);
 $d_subscribe = mysqli_real_escape_string($db, $_POST["date_subscribe"]);
 $t_subscribe = mysqli_real_escape_string($db, $_POST["time_subscribe"]);
 $d_expire = mysqli_real_escape_string($db, $_POST["date_expire"]);
 $t_expire = mysqli_real_escape_string($db, $_POST["time_expire"]);
 $no_record = mysqli_real_escape_string($db, $_POST["no_record"]);

 $typeid = mysqli_real_escape_string($db, 3);
 
 $encrypt_pass = md5($pass2.$salt);
 $encrypt_unames = md5($uname.$salt);
 $encrypt_name = base64_encode($fname);
 $encrypt_un = base64_encode($uname);
 $date_time_subscribe = $d_subscribe.' '.$t_subscribe;
 $date_time_expire = $d_expire.' '.$t_expire;

$check=mysqli_query($db,"select * from user where username ='$encrypt_unames'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    echo "<script type= 'text/javascript'>alert('Username already exists in your records! Check UN in active and expired subscribers list');</script>";
    header("refresh:0; url=add-member-subscriber");
    } else {
        if ($pass2<>$pass) {
    echo "<script type= 'text/javascript'>alert('The password you have entered is not the same!');</script>";
    header("refresh:0; url=add-member-subscriber");
 }
 else {
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO user (type_id, username, password, fullname, un, no_records, date_subscribe, date_expired) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssiss", $typeid, $encrypt_unames, $encrypt_pass, $encrypt_name, $encrypt_un, $no_record, $date_time_subscribe, $date_time_expire);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=add-member-subscriber");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
        }  
 
        }
    }  
}
?>