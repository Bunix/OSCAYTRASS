<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}


 $query ="SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = $login_id and status = 'Active' and gender = 'C'";  
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
        <li><a href="cock">Refresh</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Cock(s)</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Ring No.</th>  
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>  
                                    <th>Name</th>  
                                    <th>Date Hatched</th> 
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Ring No.</th>  
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>
                                    <th>Name</th>    
                                    <th>Date Hatched</th> 
                               </tr>  
                  </tfoot>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["ring_nr"].'</td>  
                                    <td>'.$row["colour"].'</td>  
                                    <td>'.$row["strain"].'</td>  
                                    <td>'.$row["gender"].'</td> 
                                    <td>'.$row["name"].'</td>   
                                    <td>'.$row["datehatched"].'</td>                                
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