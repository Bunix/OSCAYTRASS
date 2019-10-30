<?php 
include('session.php');
if ($login_access_id != 2) {
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
        <li><a href="club">Home</a></li>
        <li><a href="club-members">Back</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">View/ Edit Member Details</h4>

  <br />



  <?php 
    $member_id = mysqli_escape_string($db, $_GET["edit_id"]);    

    $query = "select * from club_members where id = '$member_id'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="" method="post">        
    <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Joined (M-D-Y):<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="djoined" type="date" required="required" value="<?php echo $row['d_joined'];?>"/>
        </div>        
    </div>
    <!--close div club id-->  

    <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Club ID:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="text-transform: uppercase;" class="form-control" name="club_id" type="text" required="required" value="<?php echo strtoupper(base64_decode($row['member_club_id']));?>"/>
        </div>        
    </div>
    <!--close div club id-->  
    
    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="fname" type="text" required="required" placeholder="Please Enter Full Name" value="<?php echo ucwords(base64_decode($row['name']));?>"/>         
        </div>        
    </div>
    <!--close div fullname-->    

        <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Address:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="address" type="text" required="required" placeholder="Please Enter Address"><?php echo base64_decode($row['address']);?></textarea>
        </div>        
    </div>
    <!--close div club id-->  

     <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Contact #:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="contact" type="text" required="required" placeholder="Please Enter Contact Number" value="<?php echo base64_decode($row['contact']);?>">
        </div>        
    </div>
    <!--close div contact-->

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-7">
          <input class="form-control" name="email" type="email" placeholder="Please Enter Email" value="<?php echo base64_decode($row['email']);?>">
        </div>        
    </div>
    <!--close div contact-->

     <!--start div loft-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Loft Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="text-transform: uppercase;" class="form-control" name="loft" type="text" required="required" placeholder="Please Enter Loft Name" value="<?php echo strtoupper(base64_decode($row['loft_name']));?>">
        </div>        
    </div>
    <!--close div loft-->  

     <!--start div coord lat-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Lat:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="text-transform: uppercase;" class="form-control" name="coord_lat" type="text" required="required" placeholder="Please Enter Coordinate Latitude" value="<?php echo base64_decode($row['coord_lat']);?>"/>
        </div>        
    </div>
    <!--close div coord lat-->        

    <!--start div coord long-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Long:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="text-transform: uppercase;" class="form-control" name="coord_long" type="text" required="required" placeholder="Please Enter Coordinate Longtitude" value="<?php echo base64_decode($row['coord_long']);?>"/>
        </div>        
    </div>
    <!--close div coord long-->      

   

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

        <?php 
if(isset($_POST["submit"]))
{
      
$djoined = mysqli_real_escape_string($db, $_POST["djoined"]);
$club_id = mysqli_real_escape_string($db, $_POST["club_id"]);
$fname = mysqli_real_escape_string($db, $_POST["fname"]);
$address = mysqli_real_escape_string($db, $_POST["address"]);
$contact = mysqli_real_escape_string($db, $_POST["contact"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$loft = mysqli_real_escape_string($db, $_POST["loft"]);
$coord_long = mysqli_real_escape_string($db, $_POST["coord_long"]);
$coord_lat = mysqli_real_escape_string($db, $_POST["coord_lat"]);
$hidid = mysqli_real_escape_string($db, $_POST["hidid"]);

$encrypt_club_id = base64_encode($club_id);
$encrypt_fname = base64_encode($fname);
$encrypt_address = base64_encode($address);
$encrypt_contact = base64_encode($contact);
$encrypt_email = base64_encode($email);
$encrypt_loft = base64_encode($loft);
$encrypt_coord_long = base64_encode($coord_long);
$encrypt_coord_lat = base64_encode($coord_lat);

$sql2 = "UPDATE club_members SET d_joined = '$djoined', member_club_id = '$encrypt_club_id', name ='$encrypt_fname', address = '$encrypt_address', contact = '$encrypt_contact', email = '$encrypt_email', loft_name = '$encrypt_loft', coord_long = '$encrypt_coord_long', coord_lat = '$encrypt_coord_lat' where id = '$hidid'";
mysqli_query($db,$sql2);
                   echo "<script type= 'text/javascript'>alert('Member Details is successfully updated!');</script>"; 
echo "<meta http-equiv='refresh' content='0'>";
                    mysqli_close($db);
        
}

?>