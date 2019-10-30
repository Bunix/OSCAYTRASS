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
 
 $fname = mysqli_real_escape_string($db, $_POST["fname"]);
 $position = mysqli_real_escape_string($db, $_POST["position"]);
 $d_position = mysqli_real_escape_string($db, $_POST["d_position"]);
 $address = mysqli_real_escape_string($db, $_POST["address"]); 
 $contact = mysqli_real_escape_string($db, $_POST["contact"]);
 $email = mysqli_real_escape_string($db, $_POST["email"]);
 $remarks = mysqli_real_escape_string($db, $_POST["remarks"]);

 $encrypt_name = base64_encode($fname);
 $encrypt_position = base64_encode($position);
 $encrypt_address = base64_encode($address);
 $encrypt_contact = base64_encode($contact);
 $encrypt_email = base64_encode($email);
 $encrypt_remarks = base64_encode($remarks);
    
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO club_officers (cid, name, address, contact, email, position, d_position, remarks) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssss", $login_club, $encrypt_name, $encrypt_address, $encrypt_contact, $encrypt_email, $encrypt_position, $d_position, $encrypt_remarks);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=add-club-officer");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
         
 
        }
    }  
?>