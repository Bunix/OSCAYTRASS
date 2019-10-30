<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="../jquery-3.3.1.js"></script>
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
        <li><a href="member">Home</a></li>
        <li><a href="active">Back</a></li>
    </div>
  </div>
</nav>
    

  <?php 

    $id = $login_id;
    $pid = mysqli_escape_string($db, $_GET["progeny"]);
    $query = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and id ='$pid'";

    $result = mysqli_query($db,$query);

    $row = mysqli_fetch_array($result);
      $ring = $row['ring_nr'];
      $sire_ring = $row['sire_ring_nr'];
      $dam_ring = $row['dam_ring_nr'];
  ?>

<div class="container-fluid">
  <div class="row">

  <div class="col-sm-4">      

    <div class="card" style="width:400px;">
    <div style="width: 200px; height: 200px; background-color: #535c68;">
      <img class="card-img-top" src="<?php echo $row['photo'];?>" style="width: 200px; height: 200px; color: white;" alt="Pigeon image">
    </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($row['ring_nr'])?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($row['name'])?></strong><br>
        Color: <strong><?php echo ucwords($row['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($row['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($row['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($row['datehatched'])?></strong><br>
        Remarks: <?php echo $row['remarks']?>
      </p>
  </div>
</div>

  </div><!---end-col-sm-4-->

  <div class="col-sm-8">

      <div>
        <h4>Youngsters of <?php echo strtoupper($row['ring_nr']);?></h4>
      </div>
     
     <!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s >
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Status</th> 
                                    <th>Ring No.</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>  
                                    <th>Name</th> 
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>Remarks</th>
                                    <th>Grandchildren</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                     <th>No.</th> 
                                    <th>Status.</th> 
                                    <th>Ring No.</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>
                                    <th>Name</th>   
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>Remarks</th>
                                    <th>Grandchildren</th>
                               </tr>  
                  </tfoot>
                  <?php 

                          $sirequery ="SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = $login_id and sire_ring_nr = '$ring'";  
 $sireresult = mysqli_query($db, $sirequery); 
$sno = 1;
                          while($row2 = mysqli_fetch_array($sireresult))                            
                          {  ?>
                  <form action="" method="post">
                    <tbody>                   
                               <tr>  
                                    <td><?php echo $sno; ?></td>
                                    <td><?php echo $row2["status"]; ?></td>
                                    <td><?php echo strtoupper($row2["ring_nr"]); ?></td>
                                    <td><?php echo $row2["colour"]; ?></td>
                                    <td><?php echo ucwords($row2["strain"]); ?></td>
                                    <td><?php echo $row2["gender"]; ?></td>
                                    <td><?php echo strtoupper($row2["name"]); ?></td>
                                    <td><?php echo $row2["datehatched"]; ?></td>
                                   <td><?php echo strtoupper($row2["sire_ring_nr"]);?></td>
                                   <td><?php echo strtoupper($row2["dam_ring_nr"]);?></td>
                                   <td><?php echo $row2["remarks"];?></td>
                                   <td><input type="hidden" name="hiddenid" value="<?php echo $row2["ring_nr"]; ?>"><button class='btn btn-primary btn-xs' type='submit' name='submit'>view</button></td>                
                               </tr>                                                           
                          </tbody>
                          </form>
                          <?php  $sno ++;}  
                          ?>  
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      <br>
<?php 

if(isset($_POST["submit"])) { 
  $grandid = $_POST['hiddenid'];
  ?>
  
<div>
        <h4>Grandchildren of <?php echo strtoupper($row['ring_nr']).' from '.strtoupper($grandid);?></h4>
      </div>
     
     <!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>No.</th>
                                    <th>Status.</th> 
                                    <th>Ring No.</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>  
                                    <th>Name</th> 
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>Remarks</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>No.</th>
                                    <th>Status.</th> 
                                    <th>Ring No.</th> 
                                    <th>Colour</th>  
                                    <th>Strain</th>  
                                    <th>Gender</th>
                                    <th>Name</th>   
                                    <th>Date Hatched</th> 
                                    <th>Sire</th> 
                                    <th>Dam</th>
                                    <th>Remarks</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php 

                          $grandquery ="SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = $login_id and sire_ring_nr = '$grandid'";  
 $grandresult = mysqli_query($db, $grandquery); 
$sno = 1;
                          while($grandrow = mysqli_fetch_array($grandresult))                            
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$sno.'</td>
                                    <td>'.$grandrow["status"].'</td> 
                                    <td>'.strtoupper($grandrow["ring_nr"]).'</td>  
                                    <td>'.$grandrow["colour"].'</td>  
                                    <td>'.ucwords($grandrow["strain"]).'</td>  
                                    <td>'.$grandrow["gender"].'</td> 
                                    <td>'.strtoupper($grandrow["name"]).'</td> 
                                    <td>'.$grandrow["datehatched"].'</td> 
                                    <td>'.strtoupper($grandrow["sire_ring_nr"]).'</td>
                                    <td>'.strtoupper($grandrow["dam_ring_nr"]).'</td>
                                    <td>'.$grandrow["remarks"].'</td>
                                    
                               </tr>  
                               ';  
                          $sno ++; }  
                       }
                          ?>  



      
                          </form>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
  </div><!---end-col-sm-4-->

<!------End Sire ---->

 
</div> 
</div>

  </div>

 </body>
</html>
<!-- Javascript -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>

        <script type="text/javascript">
function grand(id)
{
        window.location.href='view-active-pigeon?pigeon='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>