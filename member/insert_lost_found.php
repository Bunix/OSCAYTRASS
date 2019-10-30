<?php 
include('session.php');
?>

<?php
if(isset($_POST['submit'])) {

try {
	$pid = mysqli_real_escape_string($db, $_POST["pid"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
     

    //insert training
    $sql = 'INSERT INTO lost_found (uid, pid) VALUES ("'.$login_id.'","'.$pid.'")';
    
    if (mysqli_query($db, $sql)) {
    	echo "<script type= 'text/javascript'>alert('New Data Added Successfully!');</script>";	
	  header("refresh:0; url=my-lost-and-found");
    	 
    } else

    {
    	echo "<script type= 'text/javascript'>alert('Error! Same lost pigeon are not allowed to publish or save twice');</script>";
    	header("refresh:0; url=my-lost-and-found");
    }

    
    mysqli_close($db);
  
} catch (Exception $e) {
	echo 'Message: Error Happen';
	header("refresh:2; url=my-lost-and-found");
}
 }

?>