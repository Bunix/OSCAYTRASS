<?php 
include('session.php');
if ($login_access_id != 1) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

 $sql_query="DELETE FROM status WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Refresh: 0; url=list-status");
}

  $query ="SELECT * FROM status order by status asc";  
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
        <li><a href="list-status">Refresh</a></li>
        <li><a href="#myStatus" data-toggle="modal">Add</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">List of Pigeon Status</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Status</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Status</th> 
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
                                    <td>'.$row["status"].'</td>                                    
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

<!-- Modal change password -->
<div id="myStatus" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Add Pigeon Status</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="status" placeholder="Type-in New Pigeon Status" required="required">   
          </div>
          
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
     if(confirm('Are you sure you want to delete selected status?'))
     {
        window.location.href='list-status?delete_id='+id;
     }
}
</script>

<?php
if(isset($_POST['submit'])) {

$status = mysqli_real_escape_string($db, $_POST["status"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
    
    //insert results from the form input
    $sql = 'INSERT INTO status (status) VALUES ("'.$status.'")';     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Pigeon Status Added Successfully!');</script>"; 
  echo "<meta http-equiv='refresh' content='0'>";
      mysqli_close($db);
    }
?>