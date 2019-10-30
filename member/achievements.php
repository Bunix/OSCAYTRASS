<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

$query ="SELECT p_details.uid, p_details.ring_nr, p_details.id, p_achievement.id as achid, p_achievement.uid, p_achievement.achievement, p_achievement.pid FROM p_achievement left join p_details on p_achievement.uid = p_details.uid and p_achievement.pid = p_details.id where p_achievement.uid = '$login_id'";  
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
        <li><a href="member">Back</a></li>
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
                                    <th>Ring No.</th>
                                    <th>Achievement</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Ring No.</th>
                                    <th>Achievement</th>   
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                                                   
                          {  
                                      
                               echo '  
                               <tr class="delete_mem'.$row["achid"].' ?>">  
                                    <td>'.strtoupper($row["ring_nr"]).'</td> 
                                    <td>'.$row["achievement"].'</td>                           
                                    <td>
            <a style="width: 50%;" href="javascript:achievement_id('.$row["achid"].')" class="btn btn-primary btn-xs" >View</a><br><br/>
           <a style="width: 50%;" id="'.$row["achid"].'" class="btn btn-danger btn-xs"> Delete</a>
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
function achievement_id(id)
{
        window.location.href='view-achievement-2?achievement_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this result?")) {
                $.ajax({
                    type: "GET",
                    url: "delete_achievement.php",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".delete_mem" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>