<?php 
include('session.php');
    if ($login_access_id != 1) {
  header("location:../logout.php");
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Out-Of-School-Youth Tracking System</title>
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
        <li><a href="add-brgy-user">Refresh</a></li>
    </div>
  </div>
</nav>


    <h4 align="center">Add Account for Barangay Admin </h4>
    <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>

  <br />
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="insert-brgy-user" method="post">
    
    <!-- start div Add Username-->       
    <div class="form-group">
       
        <label class="col-sm-3 control-label">Username:<label style="color: red">*</label></label>
      
          <div class="col-sm-7">
            <input class="form-control" name="uname" type="text" required="required" placeholder="Please Enter Username"/>
          </div>

    </div>
    <!-- close div Add Username--> 

    <!--start div add Password-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Enter Password:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="pass" type="password" required="required" placeholder="Please Enter Password"/>
      </div>
    </div>
    <!--close div add password-->
    
    <!--start div add Password-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Confirm Password:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="pass2" type="password" required="required" placeholder="Please Confirm Password"/>
      </div>
    </div>
    <!--close div add password-->

    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Full Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="fname" type="text" required="required" placeholder="Please Enter Full Name of User"/>         
        </div>        
    </div>
    <!--close div fullname-->  

   
    <!-- start div Select club-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Select Barangay:<label style="color: red">*</label></label>      
          <div class="col-sm-7">
            <select class="form-control" name="club" required="required">
              <option value="">--Select--</options>
          <?php 
            $sql="select * from barangay order by club_acronym";
            $res=$db->query($sql);
            while ($row=$res->fetch_assoc()) {
              echo "<option value='{$row["id"]}'>
              ".base64_decode($row["club_acronym"])." | ".base64_decode($row["club_name"])."</option>";
            }
          ?>                
            </select>
          </div>
    </div>
    <!-- close div Select club--> 
    <div class="form-group">      
        <div class="col-sm-7" style="text-align: center;">
          <br>
        <button class="btn btn-primary" type="submit" name="submit">Save</button>             
      <br />       
        </div>  

    </div>
    <!--close div no records-->
      
    </div>
  </form>
</div>
<!--end div form-->

   
 </body>
</html>
<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>