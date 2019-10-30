<?php 
include('session.php');
 if ($login_access_id != 2) {
  header("location:../logout.php");
}

?>

<html lang="en">
<head>

<title>Philippine Pigeon Management System</title>
<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <script src="../jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>  
 <link rel="shortcut icon" href="../assets/ico/favicon.png">

<!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
<script type="text/javascript" src="formden.js"></script>

<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="bootstrap-iso.css" />


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
        <li class="active"><a href="club">Home</a></li> 
        <li ><a href="list-other-race">Race List</a></li>       
      </ul><!--end nav-barnav-->            
    </div><!---myNavbar-->
  </div><!---container-fluid-->
</nav>  
<!--start div Form-->
<div class="container">  
	<h3>Add <b>Other Race</b></h3> 
  <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>
  <br>
   <form class="form-horizontal" action="insert-other-race" method="post">
      
    <!--start div add type-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Type:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: uppercase;" class="form-control" type="text" name="type" required="required" placeholder="Please Enter type or category of Race"/>           
      </div>

    </div>
    <!--close div add type-->


   
    <!--start div add race point-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Race Point:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: capitalize;" class="form-control" type="text" name="point" required="required" placeholder="Please Enter Race Point"/>
      </div>
    </div>
    <!--close div add race point-->

    <!--start div coord lat-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Latitude (Decimal degrees):<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: capitalize;" class="form-control" name="coord_lat" type="text" required="required" placeholder="Sample 13.494884"/>
        </div>
    </div>
    <!--close div coord lat-->

    <!--start div coord long-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Longtitude (Decimal degrees):<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: capitalize;" class="form-control" name="coord_long" type="text" required="required" placeholder="Sample 120.951478"/>
        </div>
    </div>
    <!--close div coord long-->
          
     <!--start div date Date Training-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Start:<label style="color: red">*</label></label>
        <div class="col-sm-7">
                <input class="form-control" name="datestart" type="date" required="required"/>                
         </div>              
    </div>
    <!--close div date Date Training-->

<!--start div date expire-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time Expire:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          
                <input class="form-control" name="dateexpire" type="date" required="required"/>
                <input class="form-control" name="timeexpire" type="time" required="required"/>                
                                
         </div>              
    </div>
    <!--close div date expire-->

<!--start div date release-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time Release:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          
                <input class="form-control" name="daterelease" type="date" required="required"/>
                <input class="form-control" name="timerelease" type="time" required="required"/>                
                                
         </div>              
    </div>

    <div class="form-group">
        <div class="col-sm-7 control-label">        	
        	<br>
        	<button class="btn btn-primary" type="submit" name="submit">Save</button>
      </div>
    </div>          
  </form>
</div>
<!--end div form-->

</body>
</html>