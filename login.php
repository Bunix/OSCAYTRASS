<?php
   require ('config/config.php');
   require "config/pass.php";
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $decrypt_pass = md5($mypassword.$salt);
      $decrypt_username = md5($myusername.$salt);


      $sql = "SELECT * FROM user WHERE username = '$decrypt_username' and password = '$decrypt_pass'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $active_id = $row['id'];
      $active = $row['username'];
      $active_access = $row['type_id'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $decrypt_username;
         $access = $active_access;

         switch ($access) {
            case 1:
               header("location: admin/admin");
               exit;
               break;
            case 2:
               header("location: barangay/barangay");
               exit;
               break;   
            case 3:
               header("location: member/member");
               exit;
               break;         
         }
        
              
      }else {
         echo "<script type= 'text/javascript'>alert('Your Login Name or Password is invalid');</script>";
      }
      
   }
   header("refresh:0; url=/oscaytrass");

?>
