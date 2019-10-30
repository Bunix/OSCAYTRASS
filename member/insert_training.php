<?php 
include('session.php');
?>

<?php
if(isset($_POST['submit'])) {

$type = mysqli_real_escape_string($db, base64_encode($_POST["type"]));
$point = mysqli_real_escape_string($db, base64_encode($_POST["point"]));
$lat = mysqli_real_escape_string($db, base64_encode($_POST["coord_lat"]));
$long = mysqli_real_escape_string($db, base64_encode($_POST["coord_long"]));
$datestart = mysqli_real_escape_string($db, $_POST["datestart"]);
$datetimerelease = mysqli_real_escape_string($db, $_POST["daterelease"]." ".$_POST["timerelease"]);
$datetimeexpire = mysqli_real_escape_string($db, $_POST["dateexpire"]." ".$_POST["timeexpire"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO training (uid, type, race_point, coord_lat, coord_long, date_start, time_release, date_expire) VALUES ("'.$login_id.'","'.$type.'","'.$point.'","'.$lat.'", "'.$long.'","'.$datestart.'","'.$datetimerelease.'","'.$datetimeexpire.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Training Schedule Added Successfully!');</script>";	
	  header("refresh:0; url=add-training");
    mysqli_close($db);
   }
?>