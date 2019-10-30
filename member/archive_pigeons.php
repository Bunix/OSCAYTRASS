<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$filesql = "select photo from p_details where id='".$delete_id."'";
$fileresult = mysqli_query($db,$filesql);
$filerow = mysqli_fetch_array($fileresult);
$fileName = $filerow['photo'];

array_map('unlink', glob("$fileName"));

$filesql3 = "select file from p_achievement where pid='".$delete_id."'";
$fileresult3 = mysqli_query($db,$filesql3);
while ( $filerow3 = mysqli_fetch_array($fileresult3)) {
  $fileName3 = $filerow3['file'];

  array_map('unlink', glob("$fileName3"));
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
 header("Location: archive");
}

 $query ="SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = $login_id and status <> 'Active'";  
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
      <a class="navbar-brand" href="member">PPMS</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Archive Pigeons</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Status</th> 
                                    <th>Ring No.</th> 
                                    <th>RFID</th>
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>  
                                    <th>Name</th> 
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>How Obtain</th> 
                                    <th>Action</th> 
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Status.</th>
                                    <th>Ring No.</th>  
                                    <th>RFID</th>
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>
                                    <th>Name</th>   
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>How Obtain</th>
                                    <th>Action</th>    
                               </tr>  
                  </tfoot>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["status"].'</td> 
                                    <td>'.strtoupper($row["ring_nr"]).'</td>  
                                    <td>'.strtoupper($row["code"]).'</td>
                                    <td>'.$row["colour"].'</td>  
                                    <td>'.ucwords($row["strain"]).'</td>  
                                    <td>'.$row["gender"].'</td> 
                                    <td>'.strtoupper($row["name"]).'</td> 
                                    <td>'.$row["datehatched"].'</td> 
                                    <td>'.strtoupper($row["sire_ring_nr"]).'</td>
                                    <td>'.strtoupper($row["dam_ring_nr"]).'</td>
                                    <td>'.$row["obtain_through"].'</td>
                                    <td>
            <a href="javascript:pigeon('.$row["id"].')" class="trigger-btn" >View</a>

            <a style="padding-left: 10px;" href="javascript:edit_id('.$row["id"].')" class="trigger-btn" >Edit</a> 

           <a style="padding-left: 10px;" href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Delete </a>
                                    </td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
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
        window.location.href='active_pigeons.php?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function pigeon(id)
{
        window.location.href='view-archive-pigeon?pigeon='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function edit_id(id)
{
        window.location.href='edit-archive-pigeon?edit_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>