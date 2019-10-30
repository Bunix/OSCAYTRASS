<?php

$hen = mysqli_real_escape_string($db,'H');
$cock = mysqli_real_escape_string($db,'C');
?>

<!DOCTYPE html>
<html>
<body>
  <div class="row">
    <div class="container-fluid">
    <h3 style="float: left;">Pigeons: <strong><?php
      $query = "select count(uid) as cuid from p_details where uid = '$login_id'";
      $result = mysqli_query($db,$query);
      $row = mysqli_fetch_array($result);
      echo $row['cuid'];
    ?></strong></h3>
   
  </div>

  <div class="container-fluid">
    <h3 style="float: left;">Cocks: <strong><?php
      $query = "select count(gender) as cock from p_details where uid = '$login_id' and gender = '$cock'";
      $result = mysqli_query($db,$query);
      $row = mysqli_fetch_array($result);
      echo $row['cock'];
    ?></strong></h3>
   
  </div>

  <div class="container-fluid">
    <h3 style="float: left;">Hens: <strong><?php
      $query = "select count(gender) as hen from p_details where uid = '$login_id' and gender = '$hen'";
      $result = mysqli_query($db,$query);
      $row = mysqli_fetch_array($result);
      echo $row['hen'];
    ?></strong></h3>
   
  </div>

<div class="container-fluid">
    <h3 style="float: left;">Unknown: <strong><?php
      $query = "select count(gender) as unknown from p_details where uid = '$login_id' and gender = ''";
      $result = mysqli_query($db,$query);
      $row = mysqli_fetch_array($result);
      echo $row['unknown'];
    ?></strong></h3>
   
  </div>
  </div>

  
  
</body>
</html> 