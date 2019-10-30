<?php 
include('session.php');
?>

<?php
if(isset($_POST['submit'])) {

try {
	$pid = mysqli_real_escape_string($db, $_POST["pid"]);
    $price = mysqli_real_escape_string($db, $_POST["price"]);
    $fb = mysqli_real_escape_string($db, $_POST["fb"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
     

    //insert training
    $sql = 'INSERT INTO for_sale (uid, pid, price, fb_link) VALUES ("'.$login_id.'","'.$pid.'","'.$price.'","'.$fb.'")';
    
    if (mysqli_query($db, $sql)) {
    	echo "<script type= 'text/javascript'>alert('New For Sale Added Successfully!');</script>";	
	  header("refresh:0; url=my-for-sale");
    	 
    } else

    {
    	echo "<script type= 'text/javascript'>alert('Error! Same pigeon are not allowed to publish for sale twice');</script>";
    	header("refresh:0; url=my-for-sale");
    }

    
    mysqli_close($db);
  
} catch (Exception $e) {
	echo 'Message: Error Happen';
	header("refresh:2; url=my-lost-and-found");
}
 }

?>