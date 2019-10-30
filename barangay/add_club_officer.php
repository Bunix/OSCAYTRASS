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
        <li><a href="add-club-officer">Refresh</a></li>
        <li><a href="club-officers">Officers List</a></li>
    </div>
  </div>
</nav>


    <h4 align="center">Add Club Member</h4>
    <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>

  <br />
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="insert-club-officer" method="post">
         
    
    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="fname" type="text" required="required" placeholder="Please Enter Full Name"/>         
        </div>        
    </div>
    <!--close div fullname-->    

    <!--start div position-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Position:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="position" type="text" required="required" placeholder="Please Enter Current Position"/>         
        </div>        
    </div>
    <!--close div position-->   

    <!--start div date position-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Assigned Position:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="d_position" type="date" required="required"/>
        </div>        
    </div>
    <!--close div d position-->  

        <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Address:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="address" type="text" required="required" placeholder="Please Enter Address"></textarea>
        </div>        
    </div>
    <!--close div club id-->  

     <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Contact #:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="contact" type="text" required="required" placeholder="Please Enter Contact Number">
        </div>        
    </div>
    <!--close div contact-->

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-7">
          <input class="form-control" name="email" type="email" placeholder="Please Enter Email">
        </div>        
    </div>
    <!--close div contact-->

     <!--start div remark-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Remarks:</label>
        <div class="col-sm-7">
          <textarea class="form-control" name="remarks" type="text" placeholder="Enter Remarks"></textarea>
        </div>        
    </div>
    <!--close div remark-->  

    
    <!--start div no records-->
    <div class="form-group" style="text-align: center;">
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