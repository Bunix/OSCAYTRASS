<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

 $sql_query="DELETE FROM lost_found WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Location: my-lost-and-found");
}


 $query ="SELECT a.id as aid, a.uid as auid, a.date_publish as apublish, a.pid as apid, b.id as bid, b.ring_nr as bring, b.colour as bcolor, c.id as cid, c.loft_name as cloft, c.contact_nr as ccontact, c.address as cadd FROM lost_found as a left join p_details as b on a.pid = b.id left join user as c on a.uid = c.id where a.uid = '$login_id'";  
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
        <li><a href="my-lost-and-found">Refresh</a></li>
        <li><a href="#Add" class="trigger-btn" data-toggle="modal">Add</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">List of my lost Pigeon(s)</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Ring No.</th>  
                                    <th>Colour</th>  
                                    <th>Loft</th>  
                                    <th>Location</th> 
                                    <th>Contact #</th> 
                                    <th>D-Posted</th> 
                                    <th>Action</th>                                       
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Ring No.</th>  
                                    <th>Colour</th>  
                                    <th>Loft</th>  
                                    <th>Location</th>
                                    <th>Contact #</th> 
                                    <th>D-Posted</th>
                                    <th>Action</th>                                    
                               </tr>  
                  </tfoot>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.strtoupper($row["bring"]).'</td>  
                                    <td>'.ucwords($row["bcolor"]).'</td>  
                                    <td>'.strtoupper(base64_decode($row["cloft"])).'</td>
                                    <td>'.ucwords(base64_decode($row["cadd"])).'</td>  
                                    <td>'.base64_decode($row["ccontact"]).'</td> 
                                    <td>'.$row["apublish"].'</td>     
                                    <td>
           <a href="javascript:delete_id('.$row["aid"].')" class="trigger-btn" >Delete </a>
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

        <!-- Modal Add -->
<div id="Add" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Add Lost Pigeon</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="insert-lost-found" method="post">
          <div class="form-group">

            <label class="col-sm-3 control-label">Select Pigeon Ring Nr:</label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="pid" required>
                                  <option value="">--Select--</options>
                              <?php 
                                $sql="select id, UPPER(ring_nr) as ring from p_details where uid = $login_id order by ring_nr";
                                $res=$db->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                  echo "<option value='{$row["id"]}'>
                                  {$row["ring"]}</option>";
                                }
                              ?>                
                                </select>        <br/>  
          </div>             
          
          <div class="form-group">
            <button style="width: 50%;" type="submit" class="btn btn-primary btn-lg btn-block login-btn" name='submit'>Submit</button>
          </div>
        </form>
      </div>      
    </div>
  </div>
</div><!---end modal Add--->   
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
        window.location.href='my-lost-and-found?delete_id='+id;
     }
}
</script>