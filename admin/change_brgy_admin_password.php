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
        <li><a href="active-brgy-admin">Back</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">Change Barangay Administrator Password</h4>

  <br />



  <?php 
    $member_id = mysqli_escape_string($db, $_GET["change_pass_id"]);

    $query = "select * from user where id = '$member_id'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="update-brgy-admin-password" method="post">
        
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
      <label class="col-sm-3 control-label">Type Password:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" name="insertnewpassword" placeholder="New Password" required="required">
        </div>
    </div>
    <!--close div name--> 

    <!--start div date subscribe-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Confirm Password:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" name="insertnewpassword2" placeholder="Confirm Password" required="required">  
        </div>        
    </div>
    <!--close div date subscribe-->  
    
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