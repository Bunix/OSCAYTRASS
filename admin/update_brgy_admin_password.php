<?php 
include('session.php');
require "../config/pass.php";
?>

<?php
    if(isset($_POST['submit'])) {


$hidid = mysqli_real_escape_string($db, $_POST["hidid"]);
$pass2 = mysqli_escape_string($db,$_POST['insertnewpassword2']);
$pass = mysqli_escape_string($db,$_POST['insertnewpassword']);

$encrypt_pass = md5($pass2.$salt);

// Check connection
if (!$db) {
die("Db Connection failed: " . mysqli_connect_error());
header("Refresh: 0; active-brgy-admin");
}
if ($pass2<>$pass) {
	echo "<script type= 'text/javascript'>alert('The password you have entered is not the same!');</script>";
	header("Refresh: 0; active-brgy-admin");
}else
{
	$sql = "UPDATE user SET password = '$encrypt_pass' where id = '$hidid'";

if (mysqli_query($db,$sql)) {
	
	echo "<script type= 'text/javascript'>alert('The password is successfully change!');</script>";	
	header("Refresh: 0; active-brgy-admin");
} else {
echo "Error:" .$sql."<br>" . mysqli_error($db);
header("Refresh: 0; active-brgy-admin");
}
mysqli_close($db);
}

}
  ?>