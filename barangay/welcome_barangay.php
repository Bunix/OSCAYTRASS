<html>

   <head>
      <title>Out-Of-School-Youth Tracking System</title>
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
   
   if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql2 = "select prof_pic from user where id='".$delete_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['prof_pic'];

  array_map('unlink', glob("$fileName2"));
}

 $sql_query="DELETE FROM user WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=../logout.php");
}

if(isset($_POST['remove_photo']))
{

$filesql6 = "select prof_pic from user where id='".$login_id."'";
$fileresult6 = mysqli_query($db,$filesql6);
while ( $filerow6 = mysqli_fetch_array($fileresult6)) {
  $fileName6 = $filerow6['prof_pic'];

  array_map('unlink', glob("$fileName6"));
}

 $sql = "UPDATE user SET prof_pic = ''  where id = '$login_id'";
mysqli_query($db,$sql);
 echo "<meta http-equiv='refresh' content='0'>";
}

$noimage2 = 'profile.png';

if ($login_pic != '') {
  $prof_photo = $login_pic;
  
} else
{
  $prof_photo = $noimage2;
}

$noimage = 'logo-not-available.jpg';

$query10 = "select * from barangay where id = '".$login_club."'";
$result10 = mysqli_query($db,$query10);
$row10 = mysqli_fetch_array($result10);
$club_acro = base64_decode($row10['club_acronym']);
$club_name = base64_decode($row10['club_name']);
$club_logo = $row10['logo'];

if ($club_logo != '') {
  $logo = $row10['logo'];
  
} else
{
  $logo = $noimage;
}

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
      <a class="navbar-brand" href="">Brgy <?php echo $club_name; ?></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="">Home</a></li>
        <!---settings--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li><a href="#myAccount" class="trigger-btn" data-toggle="modal">My Subscription</a></li>
            <li><a href="edit-barangay">Update Barangay</a></li>
            <li><a href="upload-barangay-logo">Change Barangay Logo</a></li> 
            <li><a href="edit-profile">Update My Profile</a></li>
            <li><a href="javascript:delete_id(<?php echo $login_id; ?>)" class="trigger-btn" >Deactivate My Account</a></li>   
          </ul>
        </li>
        <!---end settings--->

        <!---start public--->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tools <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="https://www.pgc.umn.edu/apps/convert/" target="_blank"> Coordinate Converter</a></li>
            <li><a href="https://www.whatsmygps.com/" target="_blank">Find Coordinate</a></li>
          </ul>
        </li>
        <!---end public--->

        <li><a href="add-barangay-member">Add OSY</a></li>    
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
  <img id="blah" style="margin-top: 5%; height: 120px; width: 120px; border-radius: 50%; text-align: center; line-height: 50px;" class="card-img-top" src="<?php echo $prof_photo; ?>" alt="profile photo">
<br>
<!-----Upload Profile Photo---->
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div hidden style="text-align: center; float: left;">
      <input style="text-align: center; color: transparent; width: 50%" required="required" type="file" name="fileToUpload" id="fileToUpload" accept="image/gif, image/jpeg, image/png">  
    </div>        
    <input onclick="chooseFile();" class="btn btn-success btn-xs" type="button" value="Browse Image" >
        <input class="btn btn-primary btn-xs" type="submit" value="Upload Image" name="upload" id="upload">
    </form>

    <form class="form-horizontal" action="" method="post">
          <input class="btn btn-danger btn-xs" type="submit" value="Remove Image" name="remove_photo" onclick="return confirm('Are you sure you want to remove this image?');">
    </form>
    <!-----Upload Profile Photo---->
  <div class="card-body">
    <h4 class="card-title"><?php echo $login_session; ?></h4>
    <p class="card-text">Your subcription will expire on<br> <?php echo $login_date_expiration; ?></p>
    <a href="#myProfile" class="btn btn-warning" data-toggle="modal">See Profile</a>
  </div><!---End Card Body---->
  <br/>
  </div><!---End Car--->
</div><!--End SdeNav-->


<script>
   function chooseFile() {
      $("#fileToUpload").click();
   }
</script>

<?php
$loc_query ="SELECT coord_lat, coord_long FROM barangay where id = '".$login_club."'";  
$loc_result = mysqli_query($db, $loc_query);
$loc_row = mysqli_fetch_array($loc_result);
 ?>
<!---Main---->
<div class="col-sm-9"><!----start col-sm-9--->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div><a href="https://www.google.com/maps/place/'<?php echo base64_decode($loc_row["coord_lat"]);?>,<?php echo base64_decode($loc_row['coord_long'])?>'" target="_blank" class="trigger-btn" >
        <img style="border-radius: 50%; height: 150px; width: 150px; margin-top: 10px;" src="<?php echo $logo; ?>" alt="Club Logo"></a>
      </div>      
        <h3><strong>BRGY <?php echo strtoupper($club_name); ?></strong></h3>

        <div class="col-sm-3"><!---start members---->
            <div class="card img-rounded" style="background-color: #4e73df;">
              <div style="color: white;" class="card-header"><a style="color: white;" href="barangay-members"> <strong>Out-of-School-Children-and-Youth</strong></a></div>
                <div style="color: white;" class="card-body"><strong><?php
                    $query = "select count(*) as cmembers from club_members where cid = '$login_club'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    echo $row['cmembers'];
                  ?></strong>
                </div>
            </div>
        </div><!---- end members---->

        <div class="col-sm-2"><!----start linked members ---->
            <div class="card img-rounded" style="background-color: #1cc88a;">
              <div style="color: white;" class="card-header"><strong>Male Ages from 7 to 14</strong></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(*) as counta from club_members where cid = '$login_club' and TIMESTAMPDIFF(YEAR, dob, curdate()) <= 14 and sex = 'M'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
               echo $row['counta'];
              // $row = $login_club;
              // echo $row;
            ?></strong></div>
            </div>
        </div><!----end link members--->

        <div class="col-sm-2"><!----start officer--->
            <div class="card img-rounded" style="background-color: #1cc88a; ">
              <div style="color: white;" class="card-header"><strong>Male Ages from 15 to 24</strong></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(*) as countb from club_members where cid = '$login_club' and TIMESTAMPDIFF(YEAR, dob, curdate()) >= 15 and sex = 'M'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
              echo $row['countb'];
            ?></strong></div>
            </div>
        </div><!----end officer--->

        
<div class="col-sm-2"><!----start linked members ---->
            <div class="card img-rounded" style="background-color: #f6c23e;">
              <div style="color: white;" class="card-header"><strong>Female Ages from 7 to 14</strong></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(*) as counta from club_members where cid = '$login_club' and TIMESTAMPDIFF(YEAR, dob, curdate()) <= 14 and sex = 'F'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
               echo $row['counta'];
              // $row = $login_club;
              // echo $row;
            ?></strong></div>
            </div>
        </div><!----end link members--->

        <div class="col-sm-2"><!----start officer--->
            <div class="card img-rounded" style="background-color: #f6c23e; ">
              <div style="color: white;" class="card-header"><strong>Female Ages from 15 to 24</strong></div>
              <div style="color: white;" class="card-body"><strong><?php
              $query = "select count(*) as countb from club_members where cid = '$login_club' and TIMESTAMPDIFF(YEAR, dob, curdate()) >= 15 and sex = 'F'";
              $result = mysqli_query($db,$query);
              $row = mysqli_fetch_array($result);
              echo $row['countb'];
            ?></strong></div>
            </div>
        </div><!----end officer--->

    </div><!---end col---->      
  </div><!---End row--->
    <br>  



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
  <?php }
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
                        <small><cite title="Click to view location"><?php echo $login_address; ?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small> <br/>
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
      
      $target_dir = "admin_profile_pic/";
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
        window.location.href='view-schedule?view_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>