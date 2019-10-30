<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$sql_query1="DELETE FROM club_joined_members WHERE cid='".$login_club."' and cmid = '".$delete_id."'";
 mysqli_query($db, $sql_query1);

$filesql3 = "select photo from club_members where id='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
  $fileName3 = $filerow3['photo'];

  array_map('unlink', glob("$fileName3"));
 
 $sql_query="DELETE FROM club_members WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);



 header("Refresh: 0; url=club-members");


}

if(isset($_GET['remove_id']))
{
$remove_id = mysqli_real_escape_string($db, $_GET["remove_id"]);

$filesql2 = "select photo from club_members where id='".$remove_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['photo'];

  array_map('unlink', glob("$fileName2"));}

  $sql = "UPDATE club_members SET photo = ''  where id = '".$remove_id."'";
                  mysqli_query($db,$sql);
                   echo "<script type= 'text/javascript'>alert('Image successfully removed!');</script>"; 
  header("Refresh: 0; url=club-members");
}
}
$noimage = 'no_image.png';

  $query ="SELECT *, timestampdiff(YEAR,dob,curdate()) as age FROM club_members where cid = '$login_club' order by member_club_id";  
 $result = mysqli_query($db, $query); 
  

?>
<!DOCTYPE html>
<html>
 <head>
  <title>OSYTS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <li><a href="barangay">Home</a></li>
        <li><a href="barangay-members">Refresh</a></li>
        <li><a href="add-barangay-member">Add Member</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Out-of-School-Children-and-Youth</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Brgy ID #</th> 
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>DOB</th> 
                                    <th>Age</th>
                                    <th>Status</th>                                    
                                    <th>Address</th>                                     
                                    <th>Map</th>
                                    <th>Contact #</th> 
                                    <th>Email</th> 
                                    <th>Skills</th>
                                    <th>Nr of Sibling(s)</th>
                                    <th>Educational Attainment</th>
                                    <th>Father's Name</th>
                                    <th>Father's Occupation</th> 
                                    <th>Mother's Name</th>
                                    <th>Mother's Occupation</th> 
                                    <th>Reason(s) of being out of school</th>
                                    <th>Date Members (Y-M-D)</th>
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Brgy ID #</th> 
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>DOB</th> 
                                    <th>Age</th>
                                    <th>Status</th>                                    
                                    <th>Address</th>                              
                                    <th>Map</th>
                                    <th>Contact #</th> 
                                    <th>Email</th> 
                                    <th>Skills</th>
                                    <th>Nr of Sibling(s)</th>
                                    <th>Educational Attainment</th>
                                    <th>Father's Name</th>
                                    <th>Father's Occupation</th> 
                                    <th>Mother's Name</th>
                                    <th>Mother's Occupation</th> 
                                    <th>Reason(s) of being out of school</th>
                                    <th>Date Members (Y-M-D)</th>
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          $sno = 1;
                          while($row = mysqli_fetch_array($result)) 
                            
                          {  
                            $profile_photo = $row['photo'];

                              if ($profile_photo != '') {
                                $photo = $row['photo'];
                                
                              } else
                              {
                                $photo = $noimage;
                              }
                               echo  '  
                               <tr>  
                                    <td>'.$sno.'</td>
                                    <td style="text-align: center;"><img style="width: 60px; height: 60px; text-align: center;" src='.$photo.'>
                                    <a href="javascript:remove_id('.$row["id"].')" class="trigger-btn" >Remove </a>
                                    </td>
                                    <td>'.strtoupper(base64_decode($row["member_club_id"])).'</td>
                                    <td>'.ucwords(base64_decode($row["name"])).'</td>  
                                    <td>'.$row["sex"].'</td>
                                    <td>'.$row["dob"].'</td>
                                    <td>'.$row["age"].'</td>
                                    <td>'.$row["status"].'</td>
                                    <td>'.base64_decode($row["address"]).'</td>
                                    <td><a href="https://www.google.com/maps/place/'.base64_decode($row["coord_lat"]).','.base64_decode($row["coord_long"]).'" target="_blank" class="trigger-btn" >View</a></td>
                                    <td>'.base64_decode($row["contact"]).'</td>
                                    <td>'.base64_decode($row["email"]).'</td> 
                                    <td>'.$row["skill"].'</td>
                                    <td>'.$row["sibling"].'</td>
                                    <td>'.$row["educ"].'</td>
                                    <td>'.$row["father"].'</td>
                                    <td>'.$row["foccupation"].'</td>
                                    <td>'.$row["mother"].'</td>
                                    <td>'.$row["moccupation"].'</td>
                                    <td>'.$row["reason"].'</td>
                                    <td>'.$row["d_joined"].'</td>
                                    <td>  
            <a href="javascript:upload_id('.$row["id"].')" class="trigger-btn" >Upload Photo </a><br>          
            <a href="javascript:edit_id('.$row["id"].')" class="trigger-btn" >Edit Details </a><br>
           <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Dismember </a>
                                    </td>  
                               </tr>  
                               ' ;  
                          $sno++;} 
                          ?>  
                          </form>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

</body>
</html>

<!-- Javascript -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>


<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Are you sure you want to dismember the said selected member? All his/her records from your club will be erased upon deactivation and can no longer be undone and recover.'))
     {
        window.location.href='club-members?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function remove_id(id)
{
     if(confirm('Are you sure you want to remove profile photo.'))
     {
        window.location.href='club-members?remove_id='+id;
     }
}
</script>

<script type="text/javascript">
function edit_id(id)
{
        window.location.href='view-club-member?edit_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function upload_id(id)
{
        window.location.href='upload-member-photo?upload_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>