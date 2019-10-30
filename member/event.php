<?php
include('session.php');
$sqlEvents = "SELECT id, uid, title, start_date, end_date FROM events where uid = '$login_id' LIMIT 20";
$resultset = mysqli_query($db, $sqlEvents) or die("database error:". mysqli_error($db));
$calendar = array();

while( $rows = mysqli_fetch_assoc($resultset) ) {
// convert date to milliseconds
$start = strtotime($rows['start_date']) * 1000;
$end = strtotime($rows['end_date']) * 1000;
$calendar[] = array(
'id' =>$rows['id'],
'title' => ucwords($rows['title']),
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