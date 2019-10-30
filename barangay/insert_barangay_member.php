<?php 
include('session.php');
?>
<?php

if(isset($_POST["submit"]))
{

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
header("refresh:0; url=barangay");
}
 $djoined = mysqli_real_escape_string($db, $_POST["djoined"]);
 $club_id = mysqli_real_escape_string($db, strtoupper($_POST["club_id"]));
 $fname = mysqli_real_escape_string($db, $_POST["fname"]);
 $address = mysqli_real_escape_string($db, $_POST["address"]);
 $coord_long = mysqli_real_escape_string($db, $_POST["coord_long"]);
 $coord_lat = mysqli_real_escape_string($db, $_POST["coord_lat"]);
 $contact = mysqli_real_escape_string($db, $_POST["contact"]);
 $email = mysqli_real_escape_string($db, $_POST["email"]);

 $sex = mysqli_real_escape_string($db, $_POST["sex"]);
 $stat = mysqli_real_escape_string($db, $_POST["stat"]);
 $dob = mysqli_real_escape_string($db, $_POST["dob"]);
 $skill = mysqli_real_escape_string($db, $_POST["skill"]);
 $sibling = mysqli_real_escape_string($db, $_POST["sibling"]);
 $educ = mysqli_real_escape_string($db, $_POST["educ"]);
 $father = mysqli_real_escape_string($db, $_POST["father"]);
 $foccu = mysqli_real_escape_string($db, $_POST["foccu"]);
 $mother = mysqli_real_escape_string($db, $_POST["mother"]);
 $moccu = mysqli_real_escape_string($db, $_POST["moccu"]);
 $remark = mysqli_real_escape_string($db, $_POST["remark"]);

 $encrypt_name = base64_encode($fname);
 $encrypt_club_id = base64_encode($club_id);
 $encrypt_address = base64_encode($address);
 $encrypt_coord_long = base64_encode($coord_long);
 $encrypt_coord_lat = base64_encode($coord_lat);
 $encrypt_contact = base64_encode($contact);
 $encrypt_email = base64_encode($email);

 $secret_code = base64_encode($fname.$club_id);

    $check=mysqli_query($db,"select * from club_members where member_club_id ='$encrypt_club_id'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    echo "<script type= 'text/javascript'>alert('Barangay ID/ Member already exists in your records! Check your members list');</script>";
    header("refresh:0; url=add-barangay-member");
    } 
 else {
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO club_members (cid, member_club_id, name, address, coord_long, coord_lat, secret_code, contact, email, d_joined, sex, status, dob, skill, sibling, educ, father, foccupation, mother, moccupation, reason) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssssssssssissssss", $login_club, $encrypt_club_id, $encrypt_name, $encrypt_address, $encrypt_coord_long, $encrypt_coord_lat, $secret_code, $encrypt_contact, $encrypt_email, $djoined, $sex, $stat, $dob, $skill, $sibling, $educ, $father, $foccu, $mother, $moccu, $remark);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=add-barangay-member");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
        }  
 
        }
    }  
?>