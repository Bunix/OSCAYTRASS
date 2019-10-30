<?php 
include('session.php');
?>

<?php
    if(isset($_POST['submit'])) {

$ring = mysqli_real_escape_string($db, $_POST["ring"]);
$color = mysqli_real_escape_string($db, $_POST["color"]);
$strain = mysqli_real_escape_string($db, $_POST["strain"]);
$gender = mysqli_real_escape_string($db, $_POST["gender"]);
$name = mysqli_real_escape_string($db, $_POST["name"]);
$sire = mysqli_real_escape_string($db, $_POST["sire"]);
$dam = mysqli_real_escape_string($db, $_POST["dam"]);
$datehatched = mysqli_real_escape_string($db, $_POST["datehatched"]);
$howobtain = mysqli_real_escape_string($db, $_POST["howobtain"]);
$remarks = mysqli_real_escape_string($db, $_POST["remarks"]);
$hidid = mysqli_real_escape_string($db, $_POST["hidid"]);
$status = mysqli_real_escape_string($db, $_POST["status"]);
$rfid = mysqli_real_escape_string($db, $_POST["rfid"]);

// Check connection
if (!$db) {
die("Db Connection failed: " . mysqli_connect_error());
header("Refresh: 0; member");
}
else
{
  $sql = "UPDATE p_details SET ring_nr = '$ring', colour = '$color', strain ='$strain', gender='$gender',name='$name', sire_ring_nr ='$sire', dam_ring_nr='$dam',date_hatched='$datehatched', obtain_through='$howobtain', remarks='$remarks', status='$status', code='$rfid'  where id = '$hidid'";

if (mysqli_query($db,$sql)) {
  
  echo "<script type= 'text/javascript'>alert('Pigeon Details is successfully updated!');</script>"; 
  header("Refresh: 0; active");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; active");
}
mysqli_close($db);
}

}
  ?>