<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}


$ach_id = mysqli_real_escape_string($db, $_GET["achievement_id"]);


$query ="SELECT * FROM p_achievement where uid = '$login_id' and pid = '".$ach_id."'";  
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
        <li><a href="active">Back</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Achievements</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    
                                    <th>Achievement</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    
                                    <th>Achievement</th>   
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                                                   
                          {  
                                      
                               echo '  
                               <tr>  
                                    
                                    <td>'.$row["achievement"].'</td> 
                                    
                                    
                                    <td>
            <a href="javascript:achievement_id('.$row["id"].')" class="trigger-btn" >View</a><br>
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
        window.location.href='list-achievement?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function achievement_id(id)
{
        window.location.href='view-achievement?achievement_id='+id+'<?php
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
        window.location.href='edit-pigeon?edit_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>


<?php
if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]); 

$filesql = "select file from p_achievement where id='".$delete_id."'";
$fileresult = mysqli_query($db,$filesql);
$filerow = mysqli_fetch_array($fileresult);
$fileName = $filerow['file'];

array_map('unlink', glob("$fileName"));

 $sql_query="DELETE FROM p_achievement WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Location: active");
} ?>