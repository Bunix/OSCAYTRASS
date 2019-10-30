<?php
   include('session.php');
   
?>
<html>

   <head>
      <title>Welcome Admin</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
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
        <li class="active"><a href="welcome_admin.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="examinee_list.php">List of Examinees</a></li>
            <li><a href="user_list.php">List of Account Users</a></li>
            <li><a href="unit_list.php">List of Unit Assignment</a></li>     
            <li><a href="set_signatory.php">Set Signatory</a></li>       
            <li><a href="set_heading_address.php">Set Heading Address</a></li>
            <li><a href="set_ps_nrq.php">Set Passing Score and No. of Questions</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Examination list <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="tsgt_msgt/tsgt-msgt_questionnaire_list.php">TSgt-MSgt</a></li>
            <li><a href="ssgt_tsgt/ssgt-tsgt_questionnaire_list.php">SSgt-TSgt</a></li>
            <li><a href="sgt_ssgt/sgt-ssgt_questionnaire_list.php">Sgt-SSgt</a></li>
            <li><a href="cpl_sgt/cpl-sgt_questionnaire_list.php">Cpl-Sgt</a></li>
            <li><a href="pfc_cpl/pfc-cpl_questionnaire_list.php">PFC-Cpl</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Promex Result <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="examinee_result_list.php">All Examinee Results</a></li>
            <li><a href="search_result_by_date.php">Search Results by Date</a></li>
          </ul>
        </li>
        <!---<li><a href="#">Personnel</a></li>
        <li><a href="#">Page 3</a></li>--->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myModal" class="trigger-btn" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>  

    <img style="margin-top: 5%;" src="logo.png" alt="MCFDC Logo">
   <h1 style="color: white;">Admin Section</h1>
    <h4 style="color: white;">Welcome Back - <?php echo $login_session; ?></h4><br/>
    <!--Left List-->


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Change Password</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="update_password.php" method="post">
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
</div>     

     <footer style="text-align: center;">
       <p>Developed by: TSgt Oliver A Roca PN(M)</p>
     </footer>
  <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
   </body>

</html>
