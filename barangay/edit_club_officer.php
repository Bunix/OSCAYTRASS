<?php 
include('session.php');
    if ($login_access_id != 2) {
  header("location:../logout.php");  }
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
        <li><a href="club-officers">Back</a></li>
    </div>
  </div>
</nav>


    <h4 align="center">Edit Club Officer Details</h4>
    <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>

  <br />

  <?php 
    $member_id = mysqli_escape_string($db, $_GET["edit_id"]);    

    $query = "select * from club_officers where id = '".$member_id."' and cid = '".$login_club."'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="" method="post">
         
    
    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="fname" type="text" required="required" placeholder="Please Enter Full Name" value="<?php echo ucwords(base64_decode($row['name']));?>"/>         
        </div>        
    </div>
    <!--close div fullname-->    

    <!--start div position-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Position:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="position" type="text" required="required" placeholder="Please Enter Current Position" value="<?php echo ucwords(base64_decode($row['position']));?>"/>         
        </div>        
    </div>
    <!--close div position-->   

    <!--start div date position-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Assigned Position:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="d_position" type="date" required="required" value="<?php echo $row['d_position'];?>"/>
        </div>        
    </div>
    <!--close div d position-->  

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

     <!--start div remark-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Remarks:</label>
        <div class="col-sm-7">
          <textarea class="form-control" name="remarks" type="text" placeholder="Enter Remarks"><?php echo base64_decode($row['remarks']);?></textarea>
        </div>        
    </div>
    <!--close div remark-->  

    
    <!--start div no records-->
    <div class="form-group" style="text-align: center;">
          <br>
          <input hidden type="text" name="hidid" value="<?php echo $row['id']?>">
        <button class="btn btn-primary" type="submit" name="submit">Save</button>             
      <br />       
        </div>  

    </div>
    <!--close div no records-->

    
      
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
      
$fname = mysqli_real_escape_string($db, $_POST["fname"]);
$position = mysqli_real_escape_string($db, $_POST["position"]);
$d_position = mysqli_real_escape_string($db, $_POST["d_position"]);
$address = mysqli_real_escape_string($db, $_POST["address"]);
$contact = mysqli_real_escape_string($db, $_POST["contact"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$remarks = mysqli_real_escape_string($db, $_POST["remarks"]);
$hidid = mysqli_real_escape_string($db, $_POST["hidid"]);

$encrypt_fname = base64_encode($fname);
$encrypt_address = base64_encode($address);
$encrypt_contact = base64_encode($contact);
$encrypt_email = base64_encode($email);
$encrypt_position = base64_encode($position);
$encrypt_remarks = base64_encode($remarks);

$sql2 = "UPDATE club_officers SET name ='$encrypt_fname', address = '$encrypt_address', contact = '$encrypt_contact', email = '$encrypt_email', position = '$encrypt_position', remarks = '$encrypt_remarks', d_position = '$d_position' where id = '$hidid'";
mysqli_query($db,$sql2);
                   echo "<script type= 'text/javascript'>alert('Officer Details is successfully updated!');</script>"; 
echo "<meta http-equiv='refresh' content='0'>";
                    mysqli_close($db);
        
}

?>