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
$rfid = mysqli_real_escape_string($db, $_POST["rfid"]);

$query = "select count(*) as cuid from p_details where uid = '$login_id'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
$CUID = $row['cuid'];

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
    
if ($CUID >= $login_no_records) {
 echo "<script type= 'text/javascript'>alert('You have reached your maximum allowable number of Pigeons to be saved on the database! Please contact us at 09434253768 or email us at berdongroca79@gmail.com to upgrade your subscription. Thanks...');</script>";
 header("refresh:0; url=member");
} else {
  $check=mysqli_query($db,"select * from p_details where uid='$login_id' and ring_nr='$ring'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    echo "<script type= 'text/javascript'>alert('Ring Number Already Exists in your Records!');</script>";
    header("refresh:0; url=add-pigeon");
   } 

   $check2=mysqli_query($db,"select * from p_details where uid='$login_id' and code='$rfid'");
    $checkrows2=mysqli_num_rows($check2);

   if($checkrows2>0) {
    echo "<script type= 'text/javascript'>alert('RFID Code Already Exists in your Records!');</script>";
    header("refresh:0; url=add-pigeon");
   }

   else {  
    //insert results from the form input
    $sql = 'INSERT INTO p_details (uid, ring_nr, colour, name, strain, gender, dam_ring_nr, sire_ring_nr, date_hatched, status, obtain_through, remarks, code) VALUES ("'.$login_id.'","'.$ring.'","'.$color.'","'.$name.'","'.$strain.'","'.$gender.'","'.$dam.'","'.$sire.'","'.$datehatched.'","Active","'.$howobtain.'","'.$remarks.'","'.$rfid.'")';
     
      $result = mysqli_query($db, $sql) or die('Error querying database.');
      echo "<script type= 'text/javascript'>alert('New Pigeon Added Successfully!');</script>"; 
  header("refresh:0; url=add-pigeon");
      mysqli_close($db);
    }
}

    
   
    };
  ?>