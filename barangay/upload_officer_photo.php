<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

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
        <li><a href="club-officers">Back</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">Upload Club Officer Photo</h4>

  <br />



  <?php 
    $member_id = mysqli_escape_string($db, $_GET["upload_id"]);

    $noimage = 'profile.png';

$query10 = "select * from club_officers where id = '$member_id'";
$result10 = mysqli_query($db,$query10);
$row10 = mysqli_fetch_array($result10);
$photo = $row10['photo'];

if ($photo != '') {
  $photo2 = $row10['photo'];
  
} else
{
  $photo2 = $noimage;
}

    $query = "select * from club_officers where id = '$member_id'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container" style="text-align: center;">            
    <div class="card" style="width:100%;" >
  <img id="blah" style="margin-top: 5%; height: 250px; width: 250px; border-radius: 50%; text-align: center; line-height: 50px;" class="card-img-top" src="<?php echo $photo2; ?>" alt="profile photo"> <br>
<br>
<!-----Upload Profile Photo---->
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div hidden style="text-align: center; float: left;">
      <input style="text-align: center; color: transparent; width: 50%" required="required" type="file" name="fileToUpload" id="fileToUpload" accept="image/gif, image/jpeg, image/png">  
    </div>        
    <input onclick="chooseFile();" class="btn btn-success btn-xs" type="button" value="Browse Image" >
    <input hidden type="text" name="hidid" value="<?php echo $row['id']; ?>">

        <input class="btn btn-primary btn-xs" type="submit" value="Upload Image" name="upload" id="upload"> <br><br />
    </form>
    <!-----Upload Profile Photo---->
  
  </div><!---End Card Body---->
  <br/>
  </div><!---End Car--->
</div>
<!--end div form-->
<?php } ?>
<script>
   function chooseFile() {
      $("#fileToUpload").click();
   }
</script>

<?php 
if(isset($_POST["upload"]))
{
      $hidid = mysqli_real_escape_string($db, $_POST['hidid']);
      $target_dir = "officer_photo/";
      $target_file = basename($_FILES["fileToUpload"]["name"]);
      $tmp = $_FILES["fileToUpload"]["tmp_name"];
      $extension = explode("/",$_FILES["fileToUpload"]["type"]);
      $name = $hidid.".".$extension[1];
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 

        // Check if file already exists
            move_uploaded_file($tmp, $target_dir .$name);  

               $rename = $target_dir.$name;
               
                 $sql = "UPDATE club_officers SET photo = '".$rename."'  where id = '".$hidid."'";
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


 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

 

