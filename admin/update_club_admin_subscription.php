<?php 
include('session.php');
?>

<?php
    if(isset($_POST['submit'])) {

$d_subscribe = mysqli_real_escape_string($db, $_POST["date_subscribe"]);
$t_subscribe = mysqli_real_escape_string($db, $_POST["time_subscribe"]);
$d_expire = mysqli_real_escape_string($db, $_POST["date_expire"]);
$t_expire = mysqli_real_escape_string($db, $_POST["time_expire"]);
$hidid = mysqli_real_escape_string($db, $_POST["hidid"]);

$date_time_subscribe = $d_subscribe.' '.$t_subscribe;
$date_time_expire = $d_expire.' '.$t_expire;

// Check connection
if (!$db) {
die("Db Connection failed: " . mysqli_connect_error());
header("Refresh: 0; active-club-admin");
}
else
{
  $sql = "UPDATE user SET no_records = date_subscribe = '$date_time_subscribe', date_expired ='$date_time_expire' where id = '$hidid'";

if (mysqli_query($db,$sql)) {
  
  echo "<script type= 'text/javascript'>alert('Subscription is successfully updated!');</script>"; 
  header("Refresh: 0; active-club-admin");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; active-club-admin");
}
mysqli_close($db);
}

}
  ?>