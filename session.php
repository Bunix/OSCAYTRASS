<?php
   include('config/config.php');
   session_start();

   $user_check = mysqli_real_escape_string($db,$_SESSION['login_user']);
   $ses_sql = mysqli_query($db,"select id, username, type_id, fullname from user where username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = base64_decode($row['fullname']);
   $login_id = $row['id'];
   $login_access_id = $row['type_id'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
