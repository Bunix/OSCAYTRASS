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
      </ul><!--end nav-barnav-->            
    </div><!---myNavbar-->
  </div><!---container-fluid-->
</nav>  
<!--start div Form-->
<div class="container">  
	<h3>Add <b>Event/ Plan Schedule</b></h3> 
  <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>
  <br>
   <form class="form-horizontal" action="insert-event" method="post">
    
    <!--start div add type-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Subject:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%;" class="form-control" type="text" name="subject" required="required" placeholder="Please Enter Subject"/>           
      </div>

    </div>
    <!--close div add type-->

<!--start div add type-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Details:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea style="width: 100%;" class="form-control" type="text" name="detail" required="required" placeholder="Please Enter Details"></textarea>          
      </div>

    </div>
    <!--close div add type-->

<!--start div date start-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time Start:<label style="color: red">*</label></label>
        <div class="col-sm-7">                 
                <input class="form-control" name="datestart" placeholder="YYYY-MM-DD" type="date" required="required"/>
                <input class="form-control" name="timestart" type="time" required="required"/>                
                </div>                             
    </div>
    <!--close div date start-->

<!--start div date end-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time End:<label style="color: red">*</label></label>
        <div class="col-sm-7">          
                <input class="form-control" name="dateend" placeholder="YYYY-MM-DD" type="date" required="required"/>
                <input class="form-control" name="timeend" type="time" required="required"/>                
                </div>        
              </div>
    <!--close div date end-->
    
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