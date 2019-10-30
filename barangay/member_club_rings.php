<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

?>


<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
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
<?php 

  $mcmid = mysqli_escape_string($db, $_GET['view_id']);

    $trquery = "select * from club_members where cid = '$login_club' and id = '$mcmid'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $club_mem_id = strtoupper(base64_decode($trrow['member_club_id'])); 
    $name = ucwords(base64_decode($trrow['name']));
    $loft_name = strtoupper(base64_decode($trrow['loft_name']));  
    $mid = $trrow['id'];

// list of Rings
        $sql = "SELECT a.id as aid, a.cid as acid, a.ring_nr as aring, a.race_cat_id as acatid, a.owner_cmid as acmid, a.d_acquired as dacquired, b.id as bid, b.cat as bcat FROM club_rings as a left join race_category as b on a.race_cat_id = b.id where a.cid = '".$login_club."' and a.owner_cmid = '$mid'";
        $result = mysqli_query($db,$sql);
        

  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="club">Home</a></li>
        <li><a href="club-rings">Back</a></li>
    </div>
  </div>
</nav>
    
<div class="container-fluid" style="margin-left: 20px;">
  <p><strong>Club ID #:</strong> <?php echo strtoupper($club_mem_id);?><br>
      <strong>Name:</strong> <?php echo strtoupper($name);?> <br>
      <strong>Loft Name:</strong> <?php echo strtoupper($loft_name);?><br>
  </p>

  <h3>Member Acquired Ring Numbers</h3>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Ring Nr</th>
      <th>Date Acquired</th>
      <th>Race Category</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Ring Nr</th>
      <th>Date Acquired</th>
      <th>Race Category</th>
    </tr>
  </tfoot>
    <?php                        
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = $fetch['aring'];
        $dacquired = $fetch['dacquired']; 
        $bcat = $fetch['bcat'];              
        $hid = $fetch['aid'];
    ?>
<form>
  <tbody>
    <tr>      
      <td><?php echo strtoupper(base64_decode($ring_nr)); ?></td>
      <td><?php echo $dacquired; ?></td>
      <td><?php echo strtoupper(base64_decode($bcat)); ?></td>     
    </tr>
    
  </tbody>
</form>
  <?php
    }
    ?>
</table>

</div>

  </div>

<!-----Search Script-------->
<script>
$(document).ready(function(){
    $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#table2excel tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});

</script>

 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

