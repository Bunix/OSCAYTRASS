<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <script src="../jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>  
 <link rel="shortcut icon" href="../assets/ico/favicon.png">
 </head>

 <body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="admin">Home</a></li>
        <li><a href="active-subscribers">Back</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">Edit Member Subscription</h4>

  <br />



  <?php 

    $member_id = mysqli_real_escape_string($db, $_GET["id"]);
    $decrypt_id = urldecode(base64_decode($member_id));

    $query = "select *, date(date_subscribe) as date_sub, time(date_subscribe) as time_sub, date(date_expired) as date_exp, time(date_expired) as time_exp from user where id = '".$decrypt_id."'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="update-member-subscription" method="post">
        
    <!--start div name-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Username:</label>
        <div class="col-sm-7">
          <input class="form-control" readonly name="un" type="text" value="<?php echo ucwords(base64_decode($row['un']));?>" />
        </div>
    </div>
    <!--close div name--> 

    <!--start div name-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Number of Pigeon:</label>
        <div class="col-sm-7">
          <input class="form-control" name="nop" type="text" value="<?php echo $row['no_records'];?>" />
        </div>
    </div>
    <!--close div name--> 

    <!--start div date subscribe-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/Time Subscribe:</label>
        <div class="col-sm-7">
          <input class="form-control" name="date_subscribe" type="date" value="<?php echo $row['date_sub'];?>" /><br> 
          <input class="form-control" name="time_subscribe" type="time" value="<?php echo $row['time_sub'];?>"/>        
        </div>        
    </div>
    <!--close div date subscribe-->  

    <!--start div date expired-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/Time Expired:</label>
        <div class="col-sm-7">
          <input class="form-control" name="date_expire" type="date" value="<?php echo $row['date_exp'];?>" /><br> 
          <input class="form-control" name="time_expire" type="time" value="<?php echo $row['time_exp'];?>"/>        
        </div>        
    </div>
    <!--close div date expired-->     

      <br />
      <input hidden type="text" name="hidid" value="<?php echo $row['id']?>">
      <input style="float: left; margin-left: 40%; width: 30%; color: white;" class="btn btn-primary" type="submit" value=" Save " name="submit"/>
    </div>
  </form>
</div>
<!--end div form-->
<?php } ?>

 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>