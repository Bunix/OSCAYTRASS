<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

 $sql_query="DELETE FROM for_sale WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);
 header("Location: my-for-sale");
}


 $query ="SELECT a.id as aid, a.uid as auid, a.date_publish as apublish, a.price as aprice, a.fb_link as afb, a.pid as apid, b.id as bid, b.ring_nr as bring, b.colour as bcolor, b.strain as bstrain, b.gender as bgender, b.date_hatched as bdhatched, b.remarks as bremarks, b.photo as bphoto, c.id as cid, c.loft_name as cloft, c.contact_nr as ccontact, c.address as cadd FROM for_sale as a left join p_details as b on a.pid = b.id left join user as c on a.uid = c.id where a.uid = '$login_id'";  
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
        <li><a href="my-for-sale">Refresh</a></li>
        <li><a href="#Add" class="trigger-btn" data-toggle="modal">Add</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">List of my Pigeon(s) for sale</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Photo</th>
                                    <th>Price (Php)</th>
                                    <th>Ring No.</th>  
                                    <th>Colour</th> 
                                    <th>Strain</th>   
                                    <th>Gender</th>  
                                    <th>D-Hatched</th> 
                                    <th>Remarks</th>   
                                    <th>Loft</th>  
                                    <th>Location</th> 
                                    <th>Contact #</th> 
                                    <th>D-Posted</th> 
                                    <th>FB Link</th>
                                    <th>Action</th>                                       
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Photo</th>
                                    <th>Price (Php)</th>
                                    <th>Ring No.</th>  
                                    <th>Colour</th> 
                                    <th>Strain</th>   
                                    <th>Gender</th>  
                                    <th>D-Hatched</th> 
                                    <th>Remarks</th>   
                                    <th>Loft</th>  
                                    <th>Location</th> 
                                    <th>Contact #</th> 
                                    <th>D-Posted</th> 
                                    <th>FB Link</th>
                                    <th>Action</th>                                        
                               </tr>
                  </tfoot>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td><img style="width: 60px; height: 60px; text-align: center;" src='.$row["bphoto"].'></td>
                                    <td>'.number_format($row["aprice"]).'</td> 
                                    <td>'.strtoupper($row["bring"]).'</td> 
                                    <td>'.ucwords($row["bcolor"]).'</td>
                                    <td>'.ucwords($row["bstrain"]).'</td>  
                                    <td>'.ucwords($row["bgender"]).'</td>
                                    <td>'.ucwords($row["bdhatched"]).'</td>
                                    <td>'.ucwords($row["bremarks"]).'</td>
                                    <td>'.strtoupper(base64_decode($row["cloft"])).'</td>
                                    <td>'.ucwords(base64_decode($row["cadd"])).'</td>  
                                    <td>'.base64_decode($row["ccontact"]).'</td> 
                                    <td>'.$row["apublish"].'</td> 
                                    <td><a href="'.$row["afb"].'" target="_blank" class="trigger-btn" >Link </a></td>    
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
        <h4 class="modal-title">Add Pigeon for Sale</h4> 
          <button style="position: absolute;top: 20px; right: 20px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="insert-for-sale" method="post">
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

            <label class="col-sm-3 control-label">Price:</label>      
                            <div class="col-sm-7">
                           <input style="width: 100%;" class="form-control" type="number" name="price" required="required" placeholder="Please Enter Price (type number only)"/>
                                       <br/>  
          </div>   

          <div class="form-group">

            <label class="col-sm-3 control-label">Facebook Link:</label>      
                            <div class="col-sm-7">
                           <input style="width: 100%;" class="form-control" type="text" name="fb" placeholder="Please enter/ paste your FB link"/>
                                       <br/>  
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
        window.location.href='my-for-sale?delete_id='+id;
     }
}
</script>