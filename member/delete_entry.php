<?php
include ('session.php');
 
$delete_id = mysqli_real_escape_string($db, $_GET["id"]);
 $sql_query="DELETE FROM training_entries WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
?>