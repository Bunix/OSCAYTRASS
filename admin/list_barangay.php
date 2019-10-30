<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql3 = "select logo from barangay where id='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
$filerow3 = mysqli_fetch_array($fileresult3);
$fileName3 = $filerow3['logo'];

  array_map('unlink', glob("../barangay/"."$fileName3"));

 $sql_query="DELETE FROM barangay WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=list-club");
}

  $query ="SELECT * FROM barangay order by club_acronym asc";  
 $result = mysqli_query($db, $query); 
  

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Out-Of-School-Youth Tracking System</title>
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
        <li><a href="admin">Home</a></li>
        <li><a href="list-barangay">Refresh</a></li>
        <li><a href="#myClub" data-toggle="modal">Add</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">List of Barangays</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Brgy District</th> 
                                    <th>Brgy Name</th> 
                                    <th>Address</th> 
                                    <th>Map</th>
                                    <th>Contact #</th>
                                    <th>Email</th>
                                    <th>Coord Long</th> 
                                    <th>Coord Lat</th> 
                                    <th>Date Subscribe</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Brgy District</th> 
                                    <th>Brgy Name</th> 
                                    <th>Address</th> 
                                    <th>Map</th>
                                    <th>Contact #</th>
                                    <th>Email</th>                                   
                                    <th>Coord Long</th> 
                                    <th>Coord Lat</th> 
                                    <th>Date Subscribe</th>
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          $sno = 1;
                          while($row = mysqli_fetch_array($result)) 

                          {     
                                                          
                               echo  '  
                               <tr>  
                                    <td>'.$sno.'</td>
                                    <td>'.base64_decode($row["club_acronym"]).'</td>
                                    <td>'.base64_decode($row["club_name"]).'</td> 
                                    <td>'.base64_decode($row["address"]).'</td>
                                    <td><a href="https://www.google.com/maps/place/'.base64_decode($row["coord_lat"]).','.base64_decode($row["coord_long"]).'" target="_blank" class="trigger-btn" >View</a></td>
                                    <td>'.base64_decode($row["contact"]).'</td> 
                                    <td>'.base64_decode($row["email"]).'</td>     
                                    <td>'.base64_decode($row["coord_long"]).'</td>
                                    <td>'.base64_decode($row["coord_lat"]).'</td>  
                                    <td>'.$row["date_subscribe"].'</td>    
                                    <td>
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

<!-- Modal add barangay -->
<div id="myClub" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Add Barangay</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label class="col-sm-3 control-label">Brgy District:<label style="color: red">*</label></label>
            <div class="col-sm-7">
            <input type="text" class="form-control" name="club_acro" placeholder="Type-in Brgy District" required="required"> 
            </div>  
          </div>
          <br><br>
          <div class="form-group">
            <label class="col-sm-3 control-label">Brgy Name:<label style="color: red">*</label></label>
            <div class="col-sm-7">
            <input type="text" class="form-control" name="club_name" placeholder="Type-in Brgy Name" required="required">   
          </div>
          </div>
          <br><br>
          
<br><br>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn" name='submit'>Submit</button>
          </div>
        </form>
      </div>      
    </div>
  </div>
</div><!---end modal change password---> 

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
     if(confirm('Are you sure you want to delete selected club?'))
     {
        window.location.href='list-barangay?delete_id='+id;
     }
}
</script>

<?php
if(isset($_POST['submit'])) {

$club_acro = mysqli_real_escape_string($db, $_POST["club_acro"]);
$club_name = mysqli_real_escape_string($db, $_POST["club_name"]);
$d_expire = mysqli_real_escape_string($db, $_POST["date_expire"]);
$t_expire = mysqli_real_escape_string($db, $_POST["time_expire"]);

$date_time_expire = $d_expire.' '.$t_expire;
$encrypt_club_acro = base64_encode($club_acro);
$encrypt_club_name = base64_encode($club_name);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
    
    //insert results from the form input
    $sql = 'INSERT INTO barangay (club_acronym, club_name, date_subscribe, date_expired) VALUES ("'.$encrypt_club_acro.'", "'.$encrypt_club_name.'", sysdate(), "'.$date_time_expire.'")';     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Barangay Added Successfully!');</script>"; 
  echo "<meta http-equiv='refresh' content='0'>";
      mysqli_close($db);
    }
?>