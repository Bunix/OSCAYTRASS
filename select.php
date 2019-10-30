<?php 
include('config.php');
require "pass.php";

$string = 'QmVyZG9uZw==';
$decrypt = base64_decode($string);

$stmt = $db->prepare("SELECT * FROM account_type");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_assoc()) {
  $type[] = base64_decode($row['type']);
  
}
var_export($type);
$stmt->close();


?>