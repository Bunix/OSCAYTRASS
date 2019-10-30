<?php 
include('session.php');
 if ($login_access_id != 3) {
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
      <a class="navbar-brand" href="member"><?php echo strtoupper($login_loft); ?></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="achievements">Back</a></li>        
      </ul><!--end nav-barnav-->            
    </div><!---myNavbar-->
  </div><!---container-fluid-->
</nav>  
<!--start div Form-->
<div class="container">  
	<h3>Pigeon's <b>Achievement</b></h3> 
  <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>
  <br>
  <?php 

    $id = $login_id;
    $pid = mysqli_escape_string($db, $_GET["achievement_id"]);
    $query = "select * from p_achievement where id = '".$pid."' and uid ='".$id."'";

    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    $achieve = $row['achievement'];
    $file = $row['file'];
     

  ?>  
        
    <!--start div add Ring Nr-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Achievement:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control"><?php echo $achieve;?></textarea>   <br><br />                 
      </div>

    </div>
    
    <!--start div add Ring Nr-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">File:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <frame>
            <img style="height: 100%; width: 100%" src="<?php echo $file;?>">
          </frame>
          
      </div>
    </div>
  
</div>
<!--end div form-->

   
</body>
</html>