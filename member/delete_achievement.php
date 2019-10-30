<?php
include ('session.php');
 
$delete_id = mysqli_real_escape_string($db, $_GET["id"]);

$sql = "select file from p_achievement where id='".$delete_id."'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);
$fileName = $row['file'];

array_map('unlink', glob("$fileName"));

 $sql_query="DELETE FROM p_achievement WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query) or die('Error querying database.');

 
?>