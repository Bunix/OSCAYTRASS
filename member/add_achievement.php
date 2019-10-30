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
<?php 

    $id = $login_id;
    $pid = mysqli_escape_string($db, $_GET["achievement_id"]);
    $query = "select * from p_details where uid = '$id' and id ='$pid'";

    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
     $pigeon_id = $row['id'];
     $user_id = $row['uid'];

  ?>  
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="active">Back</a></li>        
      </ul><!--end nav-barnav-->            
    </div><!---myNavbar-->
  </div><!---container-fluid-->
</nav>  
<!--start div Form-->
<div class="container">  
	<h3>Add Pigeon's Achievement of <b><?php echo strtoupper($row['ring_nr']); ?></b></h3> 
  <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>
  <br>
   <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

    


    <div class="form-group">
      <label class="col-sm-3 control-label">Photo of achievement:</label>
      <div class="col-sm-7">
        <div>
          <input type="file" name="fileToUpload" id="fileToUpload" required="required"><br>    
        </div>
      </div>
    </div>
    <!--start div add Ring Nr-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Achievement:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" type="text" name="achievement" required="required" placeholder="Please Enter Pigeon's Achievement"></textarea>
                   
      </div>
<script>
   function chooseFile() {
      $("#fileToUpload").click();
   }
</script>
    </div>
    <!--close div add Ring Nr-->

    <div class="form-group">
        <div class="col-sm-7 control-label">        	
        	<br>
          <input hidden type="text" name="hidid" value="<?php echo $pigeon_id?>">
        	<input class="btn btn-primary" type="submit" value="Save" name="upload" id="upload">
      </div>
    </div>          
  </form>
</div>
<!--end div form-->

</body>
</html>

<script>
  $(document).ready(function(){
    $('#upload').click(function(){
      var image_name = $('#fileToUpload').val;
      if(image_name == '')
      {
        alert("Please Select Image File");
        return false;
      }
      else
      {
        var extension = $('#fileToUpload').val().split('.').pop().toLowerCase();
        if(jQuery.inArray(extension,['gif','png','jpg','jpeg'])== -1)
        {
          alert('Invalid Image File');
          $('#fileToUpload').val('');
          return false;
        }
      }
    });
  });
</script>

<?php 
if(isset($_POST["upload"]))
{

  $target_dir = "achievement_photo/";
  $pigeonid = $pigeon_id;
  $userid = $user_id;
  $filename = basename($_FILES["fileToUpload"]["name"]);
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $tmp = $_FILES["fileToUpload"]["tmp_name"];
  $extension = explode("/",$_FILES["fileToUpload"]["type"]);
  $rename = $userid."-".$pigeonid."-".$filename.".".$extension[1];

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $hidid = mysqli_real_escape_string($db, $_POST['hidid']);
  $achv = mysqli_real_escape_string($db, $_POST['achievement']); 

  // Check if file already exists
      if (file_exists($target_file)) {
          echo "<script type= 'text/javascript'>alert('Sorry, Image name already exists. Try to upload other filename.');</script>";

          $uploadOk = 0;
      } else {
        move_uploaded_file($tmp, $target_dir .$rename);                        
                                   //$_FILES["fileToUpload"]["tmp_name"], $target_file)
       $new_name = $target_dir.$rename;

       $sql = 'INSERT INTO p_achievement (uid, pid, achievement, file) VALUES ("'.$login_id.'","'.$hidid.'","'.$achv.'","'.$new_name.'")';
     
      $result = mysqli_query($db, $sql) or die('Error querying database.');
      echo "<script type= 'text/javascript'>alert('New Pigeon's Achievement Added Successfully!');</script>"; 
      header("refresh:0; url=active");
      mysqli_close($db);
      }    
      
      
      
}

  

?>