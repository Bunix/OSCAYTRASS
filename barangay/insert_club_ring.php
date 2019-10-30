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
 
 $ringnr = mysqli_real_escape_string($db, strtoupper($_POST["ringnr"]));
 $d_acq = mysqli_real_escape_string($db, strtoupper($_POST["d_acq"]));   
 $cat = mysqli_real_escape_string($db, $_POST["cat"]);
 $member = mysqli_real_escape_string($db, strtoupper($_POST["member"]));
 
 $encrypt_ringnr = base64_encode($ringnr);
 
     try {
    $db->autocommit(FALSE); //turn on transactions
    $stmt = $db->prepare("INSERT INTO club_rings (cid, ring_nr, race_cat_id, owner_cmid, d_acquired) VALUES (?,?,?,?,?)");
    $stmt->bind_param("isiss", $login_club, $encrypt_ringnr, $cat, $member, $d_acq);   
    $stmt->execute();  
    $stmt->close();
    $db->autocommit(TRUE); //turn off transactions + commit queued queries
    echo "<script type= 'text/javascript'>alert('Record successfully saved!');</script>";  
    header("refresh:0; url=club-rings");
  } catch(Exception $e) {
    $db->rollback(); //remove all queries from queue if error (undo)
    throw $e;
        }  
 
    }  
?>