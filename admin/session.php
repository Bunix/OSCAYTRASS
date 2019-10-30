<?php
   include('../config/config.php');

   session_start();

   $user_check = mysqli_real_escape_string($db,$_SESSION['login_user']);
   $ses_sql = mysqli_query($db,"select *, sysdate() as currentdate from user where username = '$user_check'");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $currentdate = $row['currentdate'];
   $login_date_expiration = $row['date_expired'];
   $login_date_subscribe = $row['date_subscribe'];
   $login_no_records = $row['no_records'];
   $login_session = base64_decode($row['fullname']);
   $login_loft = base64_decode($row['loft_name']);
   $login_address = base64_decode($row['address']);
   $login_email = base64_decode($row['email']);
   $login_contact = base64_decode($row['contact_nr']);
   $login_pic = $row['prof_pic'];
   $login_id = $row['id'];
   $login_access_id = $row['type_id'];
   $login_no_records = $row['no_records'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
