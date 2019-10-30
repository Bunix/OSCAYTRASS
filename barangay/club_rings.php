<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);
 
 $sql_query="DELETE FROM club_rings WHERE cid='".$login_club."' and id = '".$delete_id."'";
 mysqli_query($db, $sql_query);



 header("Refresh: 0; url=club-rings");


}

if(isset($_GET['remove_id']))
{
$remove_id = mysqli_real_escape_string($db, $_GET["remove_id"]);

$filesql2 = "select photo from club_members where id='".$remove_id."'";
$fileresult2 = mysqli_query($db,$filesql2);
while ( $filerow2 = mysqli_fetch_array($fileresult2)) {
  $fileName2 = $filerow2['photo'];

  array_map('unlink', glob("$fileName2"));}

  $sql = "UPDATE club_members SET photo = ''  where id = '".$remove_id."'";
                  mysqli_query($db,$sql);
                   echo "<script type= 'text/javascript'>alert('Image successfully removed!');</script>"; 
  header("Refresh: 0; url=club-members");
}

$noimage = 'no_image.png';

  $query ="SELECT a.id as aid, a.cid as acid, a.ring_nr as aring, a.race_cat_id as acatid, a.owner_cmid as acmid, a.d_acquired as dacquired, b.id as bid, b.cat as bcat, c.member_club_id as cmcid FROM club_rings as a left join race_category as b on a.race_cat_id = b.id left join club_members as c on a.owner_cmid = c.id where a.cid = '$login_club'"; 
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
        <li><a href="club-rings">Refresh</a></li>
        <li><a href="#Entry" class="btn trigger-btn" data-toggle="modal">Add Ring Nr</a></li>
    </div>
  </div>
</nav>

<div class="container-fluid">
  
</div>
 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Released Club Rings</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>                                      
                                    <th>Ring Nr</th>
                                    <th>Date Released</th>
                                    <th>Race Category</th>
                                    <th>Owner Club ID</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Ring Nr</th>
                                    <th>Date Released</th>
                                    <th>Race Category</th>
                                    <th>Owner Club ID</th> 
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result)) 
                            
                          {
                               echo  '  
                               <tr>                                      
                                    <td>'.strtoupper(base64_decode($row["aring"])).'</td>
                                    <td>'.$row["dacquired"].'</td>
                                    <td>'.strtoupper(base64_decode($row["bcat"])).'</td>

                                    <td><a href="javascript:view_id('.$row["acmid"].')" class="trigger-btn" >'.strtoupper(base64_decode($row["cmcid"])).'</a></td>
                                    
                                    <td>  
           <a href="javascript:delete_id('.$row["aid"].')" class="trigger-btn" >Delete</a>
                                    </td>  
                               </tr>  
                               ' ;  
                          } 
                          ?>  
                          </form>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

<!-- Modal entry -->
<div id="Entry" class="modal fade">
  <div class="modal-dialog">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                  <button style="position: absolute;top: 10px; right: 40px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                  <div class="modal-body">
                    <form action="insert-club-ring" method="post">
                      <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Ring Number:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="ringnr" type="text" required="required" placeholder="Please Enter Ring Number"/>    <br>     
        </div>        
    </div>
    <!--close div fullname-->    

    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Acquired:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="d_acq" type="date" required="required"/>    <br>     
        </div>        
    </div>
    <!--close div fullname-->    

                      <!-- start div Select race cat-->       
                          <div class="form-group">                             
                            <label class="col-sm-3 control-label">Select Race Category:<label style="color: red">*</label></label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="cat" required="required">
                                  <option value="">--Select--</options>
                              <?php 
                                $sql="select id, cat from race_category where cid = $login_club order by id desc";
                                $res=$db->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                  echo "<option value='{$row["id"]}'>
                                  ".strtoupper(base64_decode($row["cat"]))."</option>";
                                }
                              ?>                
                                </select><br>
                             
                                             
                        </div>
                      <!-- close div Select race cat--> 

                      <!-- start div Select owner cmid-->       
                          <div class="form-group">   
                          <form action="" method="post">
                            <label class="col-sm-3 control-label">Select Club Member:</label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="member">
                                  <option value="">--Select--</options>
                              <?php 
                                $sql="select id, member_club_id from club_members where cid = $login_club order by member_club_id";
                                $res=$db->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                  echo "<option value=".$row["id"].">
                                  ".strtoupper(base64_decode($row["member_club_id"]))."</option>";
                                }
                              ?>                
                                </select><br>
                             
                            <button style="width: 50%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='submit'>Submit</button>
                             
                          </form>                             
                        </div>
                      <!-- close div Select owner cmid--> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>     
</div> <!---end modal entry--->

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
     if(confirm('Are you sure you want to delete this?'))
     {
        window.location.href='club-rings?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function view_id(id)
{
        window.location.href='member-club-rings?view_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

