<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

$sql_query1="DELETE FROM club_joined_members WHERE cid='".$login_club."' and id = '".$delete_id."'";
 mysqli_query($db, $sql_query1);
 header("Refresh: 0; url=linked-members");
}

$query ="SELECT a.uid, a.cid, a.id as aid, a.cmid as acmid, a.scty_code as sctycode, a.d_t_joined as adtjoined, a.loft_name as aloft, a.name as aname, b.id as bid, b.cid as bcid, b.member_club_id as bmcid, b.name as bname, b.loft_name as bloft, b.photo as bphoto, b.secret_code as bsecret FROM club_joined_members as a left join club_members as b on a.cid = b.cid and a.cmid = b.member_club_id and a.scty_code = b.secret_code where a.cid = '$login_club'";    
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
        <li><a href="club">Home</a></li>
        <li><a href="linked-members">Refresh</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Linked Members</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Club ID #</th> 
                                    <th>Loft Name</th>
                                    <th>Name</th>                                 
                                    <th>Date Linked (Y-M-D)</th>
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Club ID #</th> 
                                    <th>Loft Name</th>
                                    <th>Name</th>                                 
                                    <th>Date Linked (Y-M-D)</th>
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
                                    <td>'.strtoupper(base64_decode($row["acmid"])).'</td>
                                    <td>'.strtoupper(base64_decode($row["aloft"])).'</td>  
                                    <td>'.ucwords(base64_decode($row["aname"])).'</td>
                                    <td>'.$row["adtjoined"].'</td>                                 
                                    <td>             
           <a href="javascript:delete_id('.$row["aid"].')" class="trigger-btn" >Unlinked </a>
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
     if(confirm('Are you sure you want to unlinked the said member?'))
     {
        window.location.href='linked-members?delete_id='+id;
     }
}
</script>