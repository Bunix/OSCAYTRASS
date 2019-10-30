<?php
include ("session.php");
require "../config/pass.php";

if(isset($_POST["submit"])){	

$name = mysqli_escape_string($db,$_POST['fullname']);
$address = mysqli_escape_string($db,$_POST['address']);
$email = mysqli_escape_string($db,$_POST['email']);
$contact = mysqli_escape_string($db,$_POST['contact']);

$hidid = mysqli_escape_string($db,$_POST['hidid']);

$encrypt_name = base64_encode($name);
$encrypt_address = base64_encode($address);
$encrypt_email = base64_encode($email);
$encrypt_contact = base64_encode($contact);

// Check connection
if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
else
{
	$sql = "UPDATE user SET fullname = '$encrypt_name', address ='$encrypt_address', email='$encrypt_email' , contact_nr='$encrypt_contact' where id = '$hidid'";

if (mysqli_query($db,$sql)) {
	
	echo "<script type= 'text/javascript'>alert('Profile successfully updated!');</script>";	
	header("Refresh: 0; edit-profile");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; barangay");
}
mysqli_close($db);
}

}
?>