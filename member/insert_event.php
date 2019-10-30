<?php 
include('session.php');
?>

<?php
if(isset($_POST['submit'])) {

$title = mysqli_real_escape_string($db, $_POST["title"]);
$detail = mysqli_real_escape_string($db, $_POST["detail"]);
$datetimestart = mysqli_real_escape_string($db, $_POST["datestart"]." ".$_POST["timestart"]);
$datetimeend = mysqli_real_escape_string($db, $_POST["dateend"]." ".$_POST["timeend"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO events (uid, title, description, start_date, end_date) VALUES ("'.$login_id.'","'.$title.'","'.$detail.'","'.$datetimestart.'","'.$datetimeend.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Plan/ Event Added Successfully!');</script>";	
	  header("refresh:0; url=member");
    mysqli_close($db);
   }
?>