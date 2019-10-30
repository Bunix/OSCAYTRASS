<?php
include('session.php');
$sqlEvents = "SELECT * FROM club_schedules where cid = '$login_club' LIMIT 20";
$resultset = mysqli_query($db, $sqlEvents) or die("database error:". mysqli_error($db));
$calendar = array();

while( $rows = mysqli_fetch_assoc($resultset) ) {
// convert date to milliseconds
$start = strtotime($rows['start_date']) * 1000;
$end = strtotime($rows['end_date']) * 1000;
$calendar[] = array(
'id' =>$rows['id'],
'title' => ucwords(base64_decode($rows['subject'])),
'url' => "javascript:view_id('".$rows["id"]."')",
"class" => 'event-important',
'start' => "$start",
'end' => "$end"
);
}
$calendarData = array(
"success" => 1,
"result"=>$calendar);
echo json_encode($calendarData);
?>