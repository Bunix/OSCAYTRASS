<?php
   include('session.php');
    if ($login_access_id != 1) {
  header("location:../logout.php");
}

$member_subscriber = mysqli_real_escape_string($db, 3);
$club_subscriber = mysqli_real_escape_string($db, 2);
?>
<html>

   <head>
      <title>OSYCTS</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">
      <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
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
        <li class="active"><a href="admin">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="add-member-subscriber">Add Admin Account</a>
            <li><a href="add-brgy-user">Add Brgy Admin Account</a></li>            
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administer <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="list-barangay">Barangay</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myModal" class="trigger-btn" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>  
<h1>Admin Dashboard</h1>
<br />
</div>
<div class="container">
  <div class="row">
    <div class="col">
        <div class="col-sm-3"><!---start subscriber---->
            <div class="card img-rounded" style="background-color: #4e73df;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="active-brgy-admin"> <strong>Brgy Admin</strong></a></div>
                <div style="color: white;" class="card-body"><strong><?php
                    $query = "select count(type_id) as typeid from user where type_id = '$club_subscriber'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    echo $row['typeid'];
                  ?></strong>
                </div>
            </div>
        </div><!---- end subscriber---->

        <div class="col-sm-3"><!---start expired subscriber---->
            <div class="card img-rounded" style="background-color: tomato;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="list-barangay"> <strong>Nr of Brgy(s)</strong></a></div>
                <div style="color: white;" class="card-body"><strong><?php
                    $query = "select count(*) as brgy from barangay";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    echo $row['brgy'];
                  ?></strong>
                </div>
            </div>
        </div><!---- end expired subscriber---->

        <div class="col-sm-3"><!---start total subscriber---->
            <div class="card img-rounded" style="background-color: #00b894;">
              <div style="color: white;" class="card-header"><strong>Total OSCY</strong></div>
                <div style="color: white;" class="card-body"><strong><?php
                    $query = "select count(*) as osy from club_members";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    echo $row['osy'];
                  ?></strong>
                </div>
            </div>
        </div><!---- end total subscriber---->

        </div><!---end unknown--->
    </div><!---end col---->      
  </div><!---End row--->
</div>

<br/><br/>
<!-- Modal change password -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Change Password</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="update-password" method="post">
          <div class="form-group">
            <input type="password" class="form-control" name="insertnewpassword" placeholder="New Password" required="required">   
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="insertnewpassword2" placeholder="Confirm Password" required="required"> 
          </div>        
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn" name='submit'>Submit</button>
          </div>
        </form>
      </div>      
    </div>
  </div>
</div><!---end modal change password---> 

  <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>
   </body>

</html>
