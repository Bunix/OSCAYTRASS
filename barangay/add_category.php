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
        <li><a href="add-category">Refresh</a></li>
        <li><a href="race-categories">Category List</a></li>
    </div>
  </div>
</nav>


    <h4 align="center">Add Race Category</h4>
    <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>

  <br />
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="insert-category" method="post">
    
      
    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Category:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="cat" type="text" required="required" placeholder="Please Enter Category"/>         
        </div>        
    </div>
    <!--close div fullname-->    

        <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Description:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="desc" type="text" required="required" placeholder="Please Enter Details or Description"></textarea>
        </div>        
    </div>
    <!--close div club id-->  

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