<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}
$member_subscriber = mysqli_real_escape_string($db, 2);

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql2 = "select prof_pic from user where id='".$delete_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['prof_pic'];

  array_map('unlink', glob("../barangay/"."$fileName2"));
}

 $sql_query="DELETE FROM user WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=active-brgy-admin");
}



  $query ="SELECT a.id as aid, DATEDIFF(a.date_expired,sysdate()) as days, a.un as aun, a.fullname as afullname, a.address as aaddress, a.contact_nr as acontact, a.email as aemail, a.date_subscribe as adatesub, a.date_expired as adateexp, b.club_name as club FROM user as a left join barangay as b on a.club_id = b.id where a.type_id = '$member_subscriber' order by days";  
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
        <li><a href="active-brgy-admin">Refresh</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Active Brgy Administrator</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>UN</th> 
                                    <th>Name</th>  
                                    <th>Address</th>  
                                    <th>Contact #</th>  
                                    <th>Email</th> 
                                    <th>Date Subscribed</th>
                                    <th>Administered Barangay</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>UN</th> 
                                    <th>Name</th>  
                                    <th>Address</th>  
                                    <th>Contact #</th>  
                                    <th>Email</th> 
                                    <th>Date Subscribed</th>
                                    <th>Administered Barangay</th>
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
                                    <td>'.base64_decode($row["aun"]).'</td>
                                    <td>'.base64_decode($row["afullname"]).'</td>
                                    <td>'.base64_decode($row["aaddress"]).'</td>
                                    <td>'.base64_decode($row["acontact"]).'</td> 
                                    <td>'.base64_decode($row["aemail"]).'</td> 
                                    <td>'.$row["adatesub"].'</td> 
                                    <td>'.strtoupper(base64_decode($row["club"])).'</td>
                                    <td>
            <a href="javascript:change_pass_id('.$row["aid"].')" class="trigger-btn" >Change Password</a><br>
           <a href="javascript:delete_id('.$row["aid"].')" class="trigger-btn" >Delete </a>
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
     if(confirm('Are you sure you want to delete said barangay administrator?'))
     {
        window.location.href='active-brgy-admin?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function renew_id(id)
{
        window.location.href='edit-brgy-admin-subscription?renew_id='+id+'<?php
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
        window.location.href='change-brgy-admin-password?change_pass_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>