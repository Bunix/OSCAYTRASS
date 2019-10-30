<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql3 = "select photo from club_officers where id='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
  $fileName3 = $filerow3['photo'];

  array_map('unlink', glob("$fileName3"));
 
 $sql_query="DELETE FROM club_officers WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 echo "<script type= 'text/javascript'>alert('Details successfully deleted!');</script>";
 header("Refresh: 0; url=club-officers");

}
}
if(isset($_GET['remove_id']))
{
$remove_id = mysqli_real_escape_string($db, $_GET["remove_id"]);

$filesql4 = "select photo from club_officers where id='".$remove_id."'";
$fileresult4 = mysqli_query($db,$filesql4);
while ( $filerow4 = mysqli_fetch_array($fileresult4)) {
  $fileName4 = $filerow4['photo'];

  array_map('unlink', glob("$fileName4"));
 
 $sql = "UPDATE club_officers SET photo = ''  where id = '".$remove_id."'";
                  mysqli_query($db,$sql);
                   echo "<script type= 'text/javascript'>alert('Image successfully removed!');</script>"; 
  header("Refresh: 0; url=club-officers");

}

}
$noimage = 'no_image.png';

  $query ="SELECT * FROM club_officers where cid = '$login_club' order by name";  
 $result = mysqli_query($db, $query); 


?>
<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
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
        <li><a href="club">Home</a></li>
        <li><a href="club-officers">Refresh</a></li>
        <li><a href="add-club-officer">Add Officer</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Club Officers</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Name</th> 
                                    <th>Position</th>
                                    <th>Date Asgd Position (Y-M-D)</th>  
                                    <th>Address</th> 
                                    <th>Contact #</th> 
                                    <th>Email</th>                             
                                    <th>Remarks</th>                              
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Photo</th>
                                    <th>Name</th> 
                                    <th>Position</th>
                                    <th>Date Asgd Position (Y-M-D)</th>   
                                    <th>Address</th> 
                                    <th>Contact #</th> 
                                    <th>Email</th>                             
                                    <th>Remarks</th>             
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
                                    <td style="text-align: center;"><img style="width: 60px; height: 60px; text-align: center;" src='.$photo.'><br>
                                    <a href="javascript:remove_id('.$row["id"].')" class="trigger-btn" >Remove </a>
                                    </td>                                
                                    <td>'.ucwords(base64_decode($row["name"])).'</td>  
                                    <td>'.ucwords(base64_decode($row["position"])).'</td>
                                    <td>'.$row["d_position"].'</td>
                                    <td>'.base64_decode($row["address"]).'</td>
                                    <td>'.base64_decode($row["contact"]).'</td>
                                    <td>'.base64_decode($row["email"]).'</td> 
                                     
                                    <td>'.strtoupper(base64_decode($row["remarks"])).'</td>
                                        
                                    <td>  
            <a href="javascript:upload_id('.$row["id"].')" class="trigger-btn" >Upload Photo </a><br>          
            <a href="javascript:edit_id('.$row["id"].')" class="trigger-btn" >Edit Details </a><br>
           <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Delete </a>
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
     if(confirm('Are you sure you want to dismember the said selected officer? All his/her records from your club will be erased upon deactivation and can no longer be undone and recover.'))
     {
        window.location.href='club-officers?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function remove_id(id)
{
     if(confirm('Are you sure you want to remove his/her photo.'))
     {
        window.location.href='club-officers?remove_id='+id;
     }
}
</script>

<script type="text/javascript">
function edit_id(id)
{
        window.location.href='edit-club-officer?edit_id='+id+'<?php
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
        window.location.href='upload-officer-photo?upload_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>