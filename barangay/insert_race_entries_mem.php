<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}
?>

<?php
if(isset($_POST['submit'])) {

$ring_id = mysqli_real_escape_string($db, $_POST["ring_id"]);
$race_id = mysqli_real_escape_string($db, $_POST["rid"]);
$code = mysqli_real_escape_string($db, $_POST["code"]);

$cquery ="SELECT ring_nr, owner_cmid FROM club_rings where cid = $login_club and id = '".$ring_id."'";  
$cresult = mysqli_query($db, $cquery);
$crow = mysqli_fetch_array($cresult);

$ring_nr = $crow['ring_nr'];
$owner_id = $crow['owner_cmid'];

$encrypt_code = base64_encode($code);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
    $check=mysqli_query($db,"select * from race_entries where rid='$race_id' and ring_nr='$ring_nr'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    echo "<script type= 'text/javascript'>alert('Ring Number Already Entered in your Records!');</script>";
    header("refresh:0; url=list-race-entries?list_race=".$race_id."");
   } else{
   	//insert training
    $sql = 'INSERT INTO race_entries (cid, rid, member_id, ring_nr, code) VALUES ("'.$login_club.'","'.$race_id.'","'.$owner_id.'","'.$ring_nr.'","'.$encrypt_code.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Entry Added Successfully!');</script>";	
	  header("refresh:0; url=list-race-entries?list_race=".$race_id."");
    mysqli_close($db);
   }
    
   }
?>