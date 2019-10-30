<?php
include_once("../config/config.php");
$sql = "SELECT id, photo, ring_nr, strain FROM p_details where uid= '$login_id' and status = 'Active' and photo != '' order by rand() LIMIT 10";
$resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($conn));
$image_count = 0;
$button_html = '';
$slider_html = '';
$thumb_html = '';
while( $rows = mysqli_fetch_assoc($resultset)){
$active_class = "";
if(!$image_count) {
$active_class = 'active';
$image_count = 1;
}
$image_count++;
// slider image html
$slider_html.= "<div class='item ".$active_class."'>";
$slider_html.= "<img style='width: 100%; height: 400px;' src='".$rows['photo']."' alt='1.jpg' class='img-responsive'>";
$slider_html.= "<div class='carousel-caption'></div></div>";
// Thumbnail html
// Button html
$button_html.= "<li data-target='#carousel-example-generic' data-slide-to='".$image_count."' class='".$active_class."'></li>";
}
?>