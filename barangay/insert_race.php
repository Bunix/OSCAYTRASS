<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}
?>

<?php
if(isset($_POST['submit'])) {

$cat = mysqli_real_escape_string($db, $_POST["cat"]);
$type = mysqli_real_escape_string($db, $_POST["type"]);
$point = mysqli_real_escape_string($db, $_POST["point"]);
$datestart = mysqli_real_escape_string($db, $_POST["datestart"]);
$coord_long = mysqli_real_escape_string($db, $_POST["coord_long"]);
$coord_lat = mysqli_real_escape_string($db, $_POST["coord_lat"]);
$datetimerelease = mysqli_real_escape_string($db, $_POST["daterelease"]." ".$_POST["timerelease"]);
$datetimeexpire = mysqli_real_escape_string($db, $_POST["dateexpire"]." ".$_POST["timeexpire"]);

$encrypt_type = base64_encode($type);
$encrypt_point = base64_encode($point);
$encrypt_long = base64_encode($coord_long);
$encrypt_lat = base64_encode($coord_lat);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO race (cid, cat_id, type, race_point, date_start, time_release, date_expire, coord_long, coord_lat) VALUES ("'.$login_club.'","'.$cat.'","'.$encrypt_type.'","'.$encrypt_point.'","'.$datestart.'","'.$datetimerelease.'","'.$datetimeexpire.'","'.$encrypt_long.'","'.$encrypt_lat.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Race Schedule Added Successfully!');</script>";	
	  header("refresh:0; url=add-race");
    mysqli_close($db);
   }
?>