<?php
include ('session.php');
 
$delete_id = mysqli_real_escape_string($db, $_GET["id"]);

$trquery = "select tid, pid from training_result where id = '$delete_id'";
$trresult = mysqli_query($db,$trquery);
$trrow = mysqli_fetch_array($trresult);
$tid = $trrow['tid'];
$pid = $trrow['pid'];

//insert training
    $sql2 = "UPDATE training_entries SET clock = 0 where pid = '".$pid."' and tid = '".$tid."'";     
    $result2 = mysqli_query($db, $sql2) or die('Error querying database.');

 $sql_query="DELETE FROM training_result WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query) or die('Error querying database.');

 
?>