<?php
include ("session.php");
require "../config/pass.php";

if(isset($_POST["submit"])){	

$club_acro = mysqli_escape_string($db,$_POST['club_acro']);
$club_name = mysqli_escape_string($db,$_POST['club_name']);
$address = mysqli_escape_string($db,$_POST['address']);
$email = mysqli_escape_string($db,$_POST['email']);
$contact = mysqli_escape_string($db,$_POST['contact']);
$coord_long = mysqli_escape_string($db,$_POST['coord_long']);
$coord_lat = mysqli_escape_string($db,$_POST['coord_lat']);

$hidid = mysqli_escape_string($db,$_POST['hidid']);

$encrypt_club_acro = base64_encode($club_acro);
$encrypt_club_name = base64_encode($club_name);
$encrypt_address = base64_encode($address);
$encrypt_email = base64_encode($email);
$encrypt_contact = base64_encode($contact);
$encrypt_coord_long = base64_encode($coord_long);
$encrypt_coord_lat = base64_encode($coord_lat);

// Check connection
if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
else
{
	$sql = "UPDATE barangay SET club_acronym = '$encrypt_club_acro', club_name = '$encrypt_club_name', address ='$encrypt_address', email='$encrypt_email', contact='$encrypt_contact', coord_long = '$encrypt_coord_long', coord_lat = '$encrypt_coord_lat' where id = '$hidid'";

if (mysqli_query($db,$sql)) {
	
	echo "<script type= 'text/javascript'>alert('Club details successfully updated!');</script>";	
	header("Refresh: 0; edit-barangay");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
//header("Refresh: 0; club");
}
mysqli_close($db);
}

}
?>