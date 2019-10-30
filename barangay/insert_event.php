<?php 
include('session.php');
?>

<?php
if(isset($_POST['submit'])) {
$subject = mysqli_real_escape_string($db, $_POST["subject"]);
$detail = mysqli_real_escape_string($db, $_POST["detail"]);
$datetimestart = mysqli_real_escape_string($db, $_POST["datestart"]." ".$_POST["timestart"]);
$datetimeend = mysqli_real_escape_string($db, $_POST["dateend"]." ".$_POST["timeend"]);

$encrypt_subject = base64_encode($subject);
$encrypt_detail = base64_encode($detail);


if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO club_schedules (cid, subject, description, start_date, end_date) VALUES ("'.$login_club.'","'.$encrypt_subject.'", "'.$encrypt_detail.'","'.$datetimestart.'","'.$datetimeend.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Plan/ Event Schedule Added Successfully!');</script>";	
	  header("refresh:0; url=club");
    mysqli_close($db);
   }
?>