<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}
$club_subscriber = mysqli_real_escape_string($db, 2);

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql2 = "select logo from club where id='".$delete_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['logo'];

  array_map('unlink', glob("../club/"."$fileName2"));
}

$sql_query1="DELETE FROM club_officers WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query1);

 $sql_query2="DELETE FROM club_link_members WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query2);

$sql_query3="DELETE FROM club_joined_members WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query3);

 $sql_query4="DELETE FROM club_members WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query4);

 $sql_query5="DELETE FROM club_rings WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query5);

 $sql_query6="DELETE FROM club_schedules WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query6);

 $sql_query7="DELETE FROM race WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query7);

 $sql_query8="DELETE FROM race_category WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query8);

 $sql_query9="DELETE FROM race_entries WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query9);

 $sql_query10="DELETE FROM race_result WHERE cid='".$delete_id."'";
 mysqli_query($db, $sql_query10);

 $sql_query11="DELETE FROM user WHERE club_id='".$delete_id."'";
 mysqli_query($db, $sql_query11);

 $sql_query="DELETE FROM club WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=active-club");
}



  $query ="SELECT *, DATEDIFF(date_expired,sysdate()) as days FROM club where date_expired > sysdate() order by days";  
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
        <li><a href="admin">Home</a></li>
        <li><a href="active-club">Refresh</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Active Clubs</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Club Acro</th> 
                                    <th>Club Name</th> 
                                    <th>Address</th> 
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>FB</th>
                                    <th>Website</th>
                                    <th>Coord Long</th> 
                                    <th>Coord Lat</th> 
                                    <th>Date Subscribe</th> 
                                    <th>Date Expire Subscription</th>
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Club Acro</th> 
                                    <th>Club Name</th> 
                                    <th>Address</th> 
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>FB</th>
                                    <th>Website</th>
                                    <th>Coord Long</th> 
                                    <th>Coord Lat</th> 
                                    <th>Date Subscribe</th> 
                                    <th>Date Expire Subscription</th>
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
                                    <td>'.base64_decode($row["contact"]).'</td> 
                                    <td>'.base64_decode($row["email"]).'</td>
                                    <td><a href="'.base64_decode($row["fb_link"]).'" class="trigger-btn" target="_blank">View</a></td>
                                    <td><a href="'.base64_decode($row["website"]).'" class="trigger-btn" target="_blank">View</a></td>
                                    <td>'.base64_decode($row["coord_long"]).'</td>
                                    <td>'.base64_decode($row["coord_lat"]).'</td>  
                                    <td>'.$row["date_subscribe"].'</td>    
                                    <td>'.$row["date_expired"].'</td>        
                                    <td>
          <a href="javascript:edit_id('.$row["id"].')" class="trigger-btn" >Edit</a><br>
          <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Deactivate </a>
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
     if(confirm('Are you sure you want to deactivate said club from its subscription? All its records will be erased upon deactivation and can no longer be undone and recover.'))
     {
        window.location.href='active-club?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function renew_id(id)
{
        window.location.href='edit-member-subscription?renew_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function change_pass_id(id)
{
        window.location.href='change-member-password?change_pass_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function pigeon_id(id)
{
        window.location.href='member-pigeons?pigeon_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>