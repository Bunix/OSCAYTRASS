<?php 
include('session.php');
if ($login_access_id != 3) {
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
        <li><a href="member">Home</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">Profile</h4>

  <br />



  <?php 

    $id = $login_id;

    $query = "select * from user where id = '$id'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="update_profile.php" method="post">
        
    <!--start div name-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-7">
          <input class="form-control" name="fullname" type="text" value="<?php echo ucwords(base64_decode($row['fullname']))?>" />
        </div>
    </div>
    <!--close div name--> 

    <!--start div loft-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Loft Name:</label>
        <div class="col-sm-7">
          <input class="form-control" name="loft" type="text" value="<?php echo ucwords(base64_decode($row['loft_name']))?>" />
        </div>
    </div>
    <!--close div loft--> 
    
    <!--start div address-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Address:</label>
        <div class="col-sm-7">
          <input class="form-control" name="address" type="text" value="<?php echo ucwords(base64_decode($row['address']))?>" />
        </div>
    </div>
    <!--close div address--> 

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Contact #:</label>
        <div class="col-sm-7">
          <input class="form-control" name="contact" type="text" value="<?php echo base64_decode($row['contact_nr'])?>" />
        </div>
    </div>
    <!--close div contact--> 

     <!--start div email-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-7">
          <input class="form-control" name="email" type="email" value="<?php echo base64_decode($row['email'])?>" />
        </div>
    </div>
    <!--close div email--> 
   
    <!--start div lat-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Lat:</label>
        <div class="col-sm-7">
          <input class="form-control" name="lat" type="text" value="<?php echo base64_decode($row['coord_lat'])?>" />
        </div>
    </div>
    <!--close div lat-->    

    <!--start div long-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Long:</label>
        <div class="col-sm-7">
          <input class="form-control" name="long" type="text" value="<?php echo base64_decode($row['coord_long'])?>" />
        </div>
    </div>
    <!--close div long--> 

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