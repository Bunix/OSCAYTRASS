<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql = "select photo from p_details where id='".$delete_id."'";
$fileresult = mysqli_query($db,$filesql);
$filerow = mysqli_fetch_array($fileresult);
$fileName = $filerow['photo'];

array_map('unlink', glob("../member/"."$fileName"));

$filesql3 = "select file from p_achievement where pid='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
  $fileName3 = $filerow3['file'];

  array_map('unlink', glob("../member/"."$fileName3"));
}

$sql_query1="DELETE FROM p_achievement WHERE pid='".$delete_id."'";
 mysqli_query($db, $sql_query1);

 $sql_query2="DELETE FROM training_entries WHERE pid='".$delete_id."'";
 mysqli_query($db, $sql_query2);

$sql_query3="DELETE FROM training_result WHERE pid='".$delete_id."'";
 mysqli_query($db, $sql_query3);

$sql_query4="DELETE FROM for_sale WHERE pid='".$delete_id."'";
 mysqli_query($db, $sql_query4);

$sql_query5="DELETE FROM lost_found WHERE pid='".$delete_id."'";
 mysqli_query($db, $sql_query5);

 $sql_query="DELETE FROM p_details WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Location: active-subscribers");
}
  $member_id = mysqli_real_escape_string($db, $_GET["id"]);
  $decrypt_id = urldecode(base64_decode($member_id));

  $query2 ="SELECT * FROM user where id = '".$decrypt_id."'";  
  $result2 = mysqli_query($db, $query2);
  $row2 = mysqli_fetch_array($result2);
  $UN = base64_decode($row2['un']);

  $query3 ="SELECT count(*) as cuid FROM p_details where uid = '".$decrypt_id."'";  
  $result3 = mysqli_query($db, $query3);
  $row3 = mysqli_fetch_array($result3);
  $CUID = $row3['cuid'];

  $query ="SELECT * FROM p_details where uid = '".$decrypt_id."' order by ring_nr";  
  $result = mysqli_query($db, $query); 
  $pigeon_id = $row['id'];
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
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Account: <strong><?php echo $UN; ?></strong></h1>
          <h1 class="h3 mb-2 text-gray-800">No of Records: <strong><?php echo $CUID; ?></strong></h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Image</th>
                                    <th>Ring No.</th> 
                                    <th>RFID</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>  
                                    <th>Status</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Image</th>
                                    <th>Ring No.</th> 
                                    <th>RFID</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>
                                    <th>Status</th> 
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))                            
                          {                              
         
                               echo '  
                               <tr>  
                                    <td><img style="width: 60px; height: 60px; text-align: center;" src=../member/'.$row["photo"].'></td>
                                    <td>'.strtoupper($row["ring_nr"]).'</td>
                                    <td>'.strtoupper($row["code"]).'</td>  
                                    <td>'.$row["colour"].'</td>  
                                    <td>'.ucwords($row["strain"]).'</td>  
                                    <td>'.$row["gender"].'</td>                       
                                    <td>'.$row["status"].'</td>
                                    <td>
           <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Delete </a>
                                    </td>  
                               </tr>  
                               ';  
                          }  
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
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='member-pigeons?delete_id='+id;
     }
}
</script>