<?php
include ('session.php');
 
$delete_id = mysqli_real_escape_string($db, $_GET["id"]);

 $sql_query="DELETE FROM club_joined_members WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query) or die('Error querying database.');
 
?>