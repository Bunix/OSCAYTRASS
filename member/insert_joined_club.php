<?php 
include('session.php');
?>

<?php
if(isset($_POST['joined'])) {

$club = mysqli_real_escape_string($db, $_POST["club"]);
$cmid = mysqli_real_escape_string($db, base64_encode(strtoupper($_POST["cid"])));
$sctycode = mysqli_real_escape_string($db, $_POST["sctycode"]);
$club = mysqli_real_escape_string($db, $_POST["club"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}

$query ="SELECT count(*) as count_member FROM club_members where member_club_id = '".$cmid."' and secret_code = '".$sctycode."'";    
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$count = $row['count_member'];

if ($count<1) {
	echo "<script type= 'text/javascript'>alert('You are already joined to your club or code is already used from another club!');</script>";
	header("refresh:0; url=clubs");
} else {
	$query2 ="SELECT * FROM club_members where member_club_id = '".$cmid."' and secret_code = '".$sctycode."'";    
	$result2 = mysqli_query($db, $query2);
	$row2 = mysqli_fetch_array($result2);
	$cid = $row2['cid'];
	$mcid = $row2['member_club_id'];
	$name = $row2['name'];
	$loft = $row2['loft_name'];
	$code = $row2['secret_code'];

	//insert joined club
    $sql = 'INSERT INTO club_joined_members (uid, cid, cmid, scty_code, loft_name, name) VALUES ("'.$login_id.'","'.$cid.'","'.$mcid.'","'.$code.'","'.$loft.'","'.$name.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('You have Successfully linked to your selected club!');</script>";	
	  header("refresh:0; url=clubs");
    mysqli_close($db);
}
    
   }
?>