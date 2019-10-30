<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}
?>

<?php
if(isset($_POST['submit'])) {

$ring = mysqli_real_escape_string($db, strtoupper($_POST["ring"]));
$loft = mysqli_real_escape_string($db, strtoupper($_POST["loft"]));
$name = mysqli_real_escape_string($db, ucwords($_POST["name"]));
$lat = mysqli_real_escape_string($db, $_POST["lat"]);
$long = mysqli_real_escape_string($db, $_POST["long"]);
$race_id = mysqli_real_escape_string($db, $_POST["rid"]);
$code = mysqli_real_escape_string($db, $_POST["code"]);


$encrypt_ring = base64_encode($ring);
$encrypt_loft = base64_encode($loft);
$encrypt_name = base64_encode($name);
$encrypt_lat = base64_encode($lat);
$encrypt_long = base64_encode($long);
$encrypt_code = base64_encode($code);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
    $check=mysqli_query($db,"select * from other_race_entries where rid='".$race_id."' and ring_nr='".$encrypt_ring."'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    echo "<script type= 'text/javascript'>alert('Ring Number Already Entered in your Records!');</script>";
    header("refresh:0; url=list-other-race-entries?list_race=".$race_id."");
   } else{
   	//insert race
    $sql = 'INSERT INTO other_race_entries (cid, rid, ring_nr, loft_name, coord_lat, coord_long, name, code) VALUES ("'.$login_club.'","'.$race_id.'","'.$encrypt_ring.'","'.$encrypt_loft.'","'.$encrypt_lat.'","'.$encrypt_long.'","'.$encrypt_name.'","'.$encrypt_code.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Entry Added Successfully!');</script>";	
	  header("refresh:0; url=list-other-race-entries?list_race=".$race_id."");
    mysqli_close($db);
   }
    
   }
?>