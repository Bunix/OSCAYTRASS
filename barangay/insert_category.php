<?php 
include('session.php');
?>
<?php

if(isset($_POST["submit"]))
{

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
header("refresh:0; url=club");
}

 $cat = mysqli_real_escape_string($db, $_POST["cat"]);
 $desc = mysqli_real_escape_string($db, $_POST["desc"]);
 
 $encrypt_cat = base64_encode($cat);
 $encrypt_desc = base64_encode($desc);
 
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO race_category (cid, cat, description) VALUES (?,?,?)");
    $stmt->bind_param("iss", $login_club, $encrypt_cat, $encrypt_desc);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=add-category");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
        }  
 
    }  
?>