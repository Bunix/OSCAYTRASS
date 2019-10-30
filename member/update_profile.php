<?php
include ("session.php");
require "../config/pass.php";

if(isset($_POST["submit"])){	

$name = mysqli_escape_string($db,$_POST['fullname']);
$loft = mysqli_escape_string($db,$_POST['loft']);
$address = mysqli_escape_string($db,$_POST['address']);
$long = mysqli_escape_string($db,$_POST['long']);
$lat = mysqli_escape_string($db,$_POST['lat']);
$email = mysqli_escape_string($db,$_POST['email']);
$contact = mysqli_escape_string($db,$_POST['contact']);

$hidid = mysqli_escape_string($db,$_POST['hidid']);

$encrypt_name = base64_encode($name);
$encrypt_loft = base64_encode($loft);
$encrypt_address = base64_encode($address);
$encrypt_long = base64_encode($long);
$encrypt_lat = base64_encode($lat);
$encrypt_email = base64_encode($email);
$encrypt_contact = base64_encode($contact);

// Check connection
if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
else
{
	$sql = "UPDATE user SET fullname = '$encrypt_name', loft_name = '$encrypt_loft', address ='$encrypt_address', coord_long='$encrypt_long',coord_lat='$encrypt_lat', email='$encrypt_email' , contact_nr='$encrypt_contact' where id = '$hidid'";

if (mysqli_query($db,$sql)) {
	
	echo "<script type= 'text/javascript'>alert('Profile successfully updated!');</script>";	
	header("Refresh: 0; edit-profile");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; member");
}
mysqli_close($db);
}

}
?>