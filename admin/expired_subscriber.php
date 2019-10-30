<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}
$member_subscriber = mysqli_real_escape_string($db, 3);

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql = "select photo from p_details where uid='".$delete_id."'";
$fileresult = mysqli_query($db,$filesql);
while ( $filerow = mysqli_fetch_array($fileresult)) {
  $fileName = $filerow['photo'];
  array_map('unlink', glob("../member/"."$fileName"));
}

$filesql2 = "select prof_pic from user where id='".$delete_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['prof_pic'];

  array_map('unlink', glob("../member/"."$fileName2"));
}

$filesql3 = "select file from p_achievement where uid='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
$fileName3 = $filerow3['file'];

  array_map('unlink', glob("../member/"."$fileName3"));
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
 header("Refresh: 0; url=expired-subscribers");
}



  $query ="SELECT *, DATEDIFF(sysdate(),date_expired) as days FROM user where type_id = '$member_subscriber' and date_expired <= sysdate() order by days desc";  
 $result = mysqli_query($db, $query); 
 $uid = $row['id'];
 
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
        <li><a href="expired-subscribers">Refresh</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Expired Subscribers</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>UN</th> 
                                    <th>Loft Name</th> 
                                    <th>Name</th>  
                                    <th>Address</th>  
                                    <th>Contact #</th>  
                                    <th>Email</th> 
                                    <th>Date Subscribed</th>
                                    <th>Date Expiration</th>
                                    <th>Days expired</th>
                                    <th>Auth # P</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>UN</th> 
                                    <th>Loft Name</th> 
                                    <th>Name</th>  
                                    <th>Address</th>  
                                    <th>Contact #</th>  
                                    <th>Email</th> 
                                    <th>Date Subscribed</th>
                                    <th>Date Expiration</th>
                                    <th>Remaining days</th>
                                    <th>Auth # P</th> 
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
                                    <td>'.base64_decode($row["un"]).'</td>
                                    <td>'.base64_decode($row["loft_name"]).'</td>  
                                    <td>'.base64_decode($row["fullname"]).'</td>
                                    <td>'.base64_decode($row["address"]).'</td>
                                    <td>'.base64_decode($row["contact_nr"]).'</td> 
                                    <td>'.base64_decode($row["email"]).'</td> 
                                    <td>'.$row["date_subscribe"].'</td> 
                                    <td>'.$row["date_expired"].'</td> 
                                    <td style="text-align: center;">'.$row["days"].'</td>
                                    <td>'.number_format($row["no_records"]).'</td>
                                    <td>
            <a href="javascript:renew_id('.$row["id"].')" class="trigger-btn" >Renew</a><br><br>
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
     if(confirm('Are you sure you want to deactivate said member from his/her subscription? All his/her records will be erased upon deactivation and can no longer be undone and recover.'))
     {
        window.location.href='expired-subscribers?delete_id='+id;
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