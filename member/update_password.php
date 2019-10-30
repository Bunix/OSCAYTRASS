<?php
include ("session.php");
require "../config/pass.php";

if(isset($_POST["submit"])){	


$pass2 = mysqli_escape_string($db,$_POST['insertnewpassword2']);
$pass = mysqli_escape_string($db,$_POST['insertnewpassword']);

$encrypt_pass = md5($pass2.$salt);

// Create connection
// Check connection
if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}

if ($pass2<>$pass) {
	echo "<script type= 'text/javascript'>alert('The password you have entered is not the same!');</script>";
	header("Refresh: 0; member");
}else
{
	$sql = "UPDATE user SET password = '$encrypt_pass' where id = '$login_id'";

if (mysqli_query($db,$sql)) {
	
	echo "<script type= 'text/javascript'>alert('Your password is successfully updated!');</script>";	
	header("Refresh: 0; member");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; member");
}
mysqli_close($db);
}

}
?>