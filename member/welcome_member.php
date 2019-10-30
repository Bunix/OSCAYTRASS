<html>

   <head>
      <title>Philippine Pigeon Management System</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">
      <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.png">


<link rel="stylesheet" href="css/calendar.css">
<style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  
  .btn:focus, .btn:active, button:focus, button:active {
  outline: none !important;
  box-shadow: none !important;
}

#image-gallery .modal-footer{
  display: block;
}

.thumb{
  margin-top: 15px;
  margin-bottom: 15px;
}

  </style>


   </head>

   <body>


<?php
   include('session.php');
   include('slider.php');
    $hen = mysqli_real_escape_string($db,'H');
    $cock = mysqli_real_escape_string($db,'C');
    $unknown = mysqli_real_escape_string($db,'U');

   if ($login_access_id != 3) {
  header("location:../logout.php");
}
$noimage2 = 'profile.png';

if ($login_pic != '') {
  $prof_photo = $login_pic;
  
} else
{
  $prof_photo = $noimage2;
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql = "select photo from p_details where uid='".$delete_id."'";
$fileresult = mysqli_query($db,$filesql);
while ( $filerow = mysqli_fetch_array($fileresult)) {
  $fileName = $filerow['photo'];
  array_map('unlink', glob("$fileName"));
}

$filesql2 = "select prof_pic from user where id='".$delete_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['prof_pic'];

  array_map('unlink', glob("$fileName2"));
}

$filesql3 = "select file from p_achievement where uid='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
  $fileName3 = $filerow3['file'];

  array_map('unlink', glob("$fileName3"));
}

$sql_query1="DELETE FROM p_achievement WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query1);

 $sql_query2="DELETE FROM training_entries WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query2);

$sql_query3="DELETE FROM training_result WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query3);

 $sql_query4="DELETE FROM lost_found WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query4);

 $sql_query5="DELETE FROM for_sale WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query5);

 $sql_query6="DELETE FROM events WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query6);

 $sql_query7="DELETE FROM p_details WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query7);

 $sql_query8="DELETE FROM training WHERE uid='".$delete_id."'";
 mysqli_query($db, $sql_query8);

 $sql_query="DELETE FROM user WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=../logout.php");
}

$query9 = "select count(*) as cuid from p_details where uid = '$login_id'";
$result9 = mysqli_query($db,$query9);
$row9 = mysqli_fetch_array($result9);
$CUID = $row9['cuid'];

   if ($login_date_expiration < $currentdate) {
     echo "<script type= 'text/javascript'>alert('Your subscription has expired! Feel free to contact us to subscribe.');</script>";  
  header("Refresh: 0; url=../logout.php");
   } else{?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="">PPMS</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="">Home</a></li>
        <!---settings--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li><a href="#myAccount" class="trigger-btn" data-toggle="modal">My Subscription</a></li>
            <li><a href="edit-profile">Update Profile</a></li> 
            <li><a href="javascript:delete_id(<?php echo $login_id; ?>)" class="trigger-btn" >Deactivate Account</a></li>   
          </ul>
        </li>
        <!---end settings--->

        <!---start pigeon --->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Organizer <span class="caret"></span></a>
          <ul class="dropdown-menu">                    
            <li><a href="cock">Cock</a></li>
            <li><a href="hen">Hen</a></li>
            <li><a href="ungender">Ungender</a></li>
            <li><a href="active">Active Pigeons</a></li>
            <li><a href="archive">Archive Pigeons</a></li>
          </ul>
        </li>
        <!---end pigeon ---->

        <!---start training--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Training <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="add-training">Add Training Schedule</a></li>
            <li><a href="list-training">List of Training Schedule</a></li>
          </ul>
        </li>
        <!---end training--->

        <!---start race--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Club <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="achievements">Achievements</a></li>
            <li><a href="clubs">Joined Clubs</a></li>
          </ul>
        </li>
        <!---end race--->

        <!---start public--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">My <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="my-for-sale">My for Sale</a></li>
            <li><a href="my-lost-and-found">My Lost Bird</a></li>
          </ul>
        </li>
        <!---end public--->

        <!---start public--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Public <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="for-sale">For Sale</a></li>
            <li><a href="lost-and-found">Lost and Found</a></li>
          </ul>
        </li>
        <!---end public--->
        <li><a href="add-pigeon">Add Pigeon</a></li>    
        <li><a href="add-event">Add Event</a></li>
        

        <!---<li><a href="#">Personnel</a></li>
        <li><a href="#">Page 3</a></li>--->

      </ul><!--end nav-barnav-->

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myModal" class="trigger-btn" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>  
<!-----SideNav---->
<div class="col-sm-3 sidenav">
  <div class="card" style="width:100%;" >
  <img id="blah" style="margin-top: 5%; height: 120px; width: 120px; border-radius: 50%; text-align: center; line-height: 50px;" class="card-img-top" src="<?php echo $prof_photo; ?>" alt="Profile Picture">
<br>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div hidden style="text-align: center; float: left;">
      <input style="text-align: center; color: transparent; width: 50%" required="required" type="file" name="fileToUpload" id="fileToUpload" accept="image/gif, image/jpeg, image/png">  
    </div>        
    <input onclick="chooseFile();" class="btn btn-success btn-xs" type="button" value="Browse Image" >
        <input class="btn btn-primary btn-xs" type="submit" value="Upload Image" name="upload" id="upload">
    </form>
  <div class="card-body">
    <h4 class="card-title"><?php echo $login_session; ?></h4>
    <p class="card-text">Your subcription will expire on<br> <?php echo $login_date_expiration; ?></p>
    <p style="font-size: 12pt;" class="card-text">Nr of Pigeon Found: <strong><?php echo $CUID; ?> </strong> <br>Allowed No of Pigeon: <strong><?php echo number_format($login_no_records); ?></strong> </p>
    <a href="#myProfile" class="btn btn-warning" data-toggle="modal">See Profile</a>
  </div><!---End Card Body---->
  <br/>
  <!-------Gallery-->
<div class="row">
    <div class="navbar-collapse gallery">     
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
<ol class="carousel-indicators">
<?php echo $button_html; ?>
</ol>
<div class="carousel-inner">
<?php echo $slider_html; ?>
</div>
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>

</div>
    </div>
  </div>

  <!-------end gallery--->
</div><!---End Car--->
</div><!--End SdeNav-->


<script>
   function chooseFile() {
      $("#fileToUpload").click();
   }
</script>


<!---Main---->
<div class="col-sm-9"><!----start col-sm-9--->
<div class="container-fluid">
  <div class="row">
    <div class="col">
        <h1><strong><?php echo strtoupper($login_loft); ?></strong></h1>

        <div class="col-sm-3"><!---start pigeons---->
            <div class="card img-rounded" style="background-color: #4e73df;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="active"> <strong>Pigeons</strong></a></div>
                <div style="color: white;" class="card-body"><strong><?php
                    $query = "select count(uid) as cuid from p_details where uid = '$login_id' and status = 'Active'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    echo $row['cuid'];
                  ?></strong>
                </div>
            </div>
        </div><!---- end pigeons---->

        <div class="col-sm-3"><!----start cock ---->
            <div class="card img-rounded" style="background-color: #1cc88a;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="cock"> <strong>Cocks</strong></a></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(gender) as cock from p_details where uid = '$login_id' and gender = '$cock' and status = 'Active'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
              echo $row['cock'];
            ?></strong></div>
            </div>
        </div><!----end cock--->

        <div class="col-sm-3"><!----start hen--->
            <div class="card img-rounded" style="background-color: #f6c23e; ">
              <div style="color: white;" class="card-header"><a style="color: white;" href="hen"> <strong>Hens</strong></a></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(gender) as hen from p_details where uid = '$login_id' and gender = '$hen' and status = 'Active'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
              echo $row['hen'];
            ?></strong></div>
            </div>
        </div><!----end hen--->

        <div class="col-sm-3"><!----start unknown---->
            <div class="card img-rounded" style="background-color: #e74a3b;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="ungender"> <strong>Unknown</strong></a></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(gender) as unknown from p_details where uid = '$login_id' and gender = '$unknown' and status = 'Active'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
              echo $row['unknown'];
            ?></strong></div>
            </div>
        </div><!---end unknown--->
    </div><!---end col---->      
  </div><!---End row--->
    <br>  

<!-----Calendar----->
<div class="container-fluid">
<div class="page-header">
<div class="pull-right form-inline">
<div class="btn-group">
<button class="btn btn-primary btn-xs" data-calendar-nav="prev"><< Prev</button>
<button class="btn btn-default btn-xs" data-calendar-nav="today">Today</button>
<button class="btn btn-primary btn-xs" data-calendar-nav="next">Next >></button>
</div>
<div class="btn-group">
<button class="btn btn-warning btn-xs" data-calendar-view="year">Year</button>
<button class="btn btn-warning active btn-xs" data-calendar-view="month">Month</button>
<button class="btn btn-warning btn-xs" data-calendar-view="week">Week</button>
<button class="btn btn-warning btn-xs" data-calendar-view="day">Day</button>
</div>
</div>
<h3></h3>

</div>
<div class="row">
<div class="col-md-9">
<div id="showEventCalendar"></div>
</div>
<div class="col-md-3">
<h4>All Events List</h4>
<ul id="eventlist" class="nav nav-list"></ul>
</div>
</div>
</div>
<!---End Calendar---->




  </div><!---End Container-Fluid--->
</div><!---End Main--->

<div class="container">

</div>

 

<!-- Modal change password -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Change Password</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="password_update" method="post">
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
  <?php }
?>

<?php
$loc_query ="SELECT coord_lat, coord_long FROM user where id = '".$login_id."'";  
$loc_result = mysqli_query($db, $loc_query);
$loc_row = mysqli_fetch_array($loc_result);
 ?>
<!-- Modal profile -->
<div id="myProfile" class="modal fade">
  <div class="modal-dialog">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img style="height: 150px; width: 150px; border-radius: 50%;" src="<?php echo $login_pic; ?>" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h3><?php echo $login_session; ?></h3>
                        <h4><?php echo strtoupper($login_loft); ?></h4>
                        <small><cite title="Click to view location"><?php echo $login_address; ?> <a href="https://www.google.com/maps/place/'<?php echo base64_decode($loc_row["coord_lat"]);?>,<?php echo base64_decode($loc_row['coord_long'])?>'" target="_blank" class="trigger-btn" ><i class="glyphicon glyphicon-map-marker">
                        </i></cite></small></a> <br/>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $login_email; ?>
                            <br /></p>
                        <p>
                            <i class="glyphicon glyphicon-phone"></i><?php echo $login_contact; ?>
                            <br /></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>     
</div> <!---end profile--->

<!-- Modal Account -->
<div id="myAccount" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">My Subscription</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <div class="container-fluid">
              <p style="text-align: left;"><strong>Date Subscribed:</strong> <?php echo $login_date_subscribe; ?></p>
              <p style="text-align: left;"><strong>Date of Expiration:</strong> <?php echo $login_date_expiration; ?></p>
              <p style="text-align: left;"><strong>Authorized number of Pigeons to be saved:</strong> <?php echo number_format($login_no_records); ?></p>
            </div>          
          </div>          
      </div>      
    </div>
  </div>
</div><!---end modal Account--->     
 

  <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.backstretch.min.js"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="js/carousel-slider.js"></script>

<script type="text/javascript" src="js/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
</body>

</html>
<script type="text/javascript">
function edit_id(id){
     
        window.location.href='edit_profile?edit_id='+id;
     
}
</script>

<?php 
if(isset($_POST["upload"]))
{
      
      $target_dir = "profile_pic/";
      $target_file = basename($_FILES["fileToUpload"]["name"]);
      $tmp = $_FILES["fileToUpload"]["tmp_name"];
      $extension = explode("/",$_FILES["fileToUpload"]["type"]);
      $name = $login_id.".".$extension[1];
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 

        // Check if file already exists
            move_uploaded_file($tmp, $target_dir .$name);             
               $rename = $target_dir.$name;
                 $sql = "UPDATE user SET prof_pic = '$rename'  where id = '$login_id'";
                  mysqli_query($db,$sql);
                   echo "<script type= 'text/javascript'>alert('Image successfully uploaded!');</script>"; 

                    mysqli_close($db);
        
echo "<meta http-equiv='refresh' content='0'>";
}

?>

<!---view Image before uploaded--->
<script type="text/javascript">
  
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#fileToUpload").change(function(){
        readURL(this);
    });

</script>

<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Are you sure you want to deactivate your account? All your records will be erased upon deactivation and can no longer be undone and recover your records. Thank you for subscribing...'))
     {
        window.location.href='member?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function view_id(id)
{
        window.location.href='view-member-schedule?view_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>