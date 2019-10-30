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

 
    $id = $login_id;
    $pid = mysqli_escape_string($db, $_GET["result_id"]);   


  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
        <li><a href="active">Back</a></li>
    </div>
  </div>
</nav>
    

  
<div class="container">
  <h3>Training Results</h3>
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Type</th>
      <th>Race Pt</th>  
      <th>Distance (meters)</th>  
      <th>Time Release</th>  
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th> 
    </tr>
  </thead>
  <tfoot>
    <th>Type</th>
      <th>Race Pt</th>  
      <th>Distance (meters)</th>  
      <th>Time Release</th>   
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th>   
  </tfoot>
    <?php                        
        // list of training result
        $sql = "SELECT *, (TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60 as minutes FROM training_result where pid = '".$_GET['result_id']."' order by id desc";
        $result = mysqli_query($db,$sql);
        while($fetch = mysqli_fetch_array($result)){
        $type = strtoupper(base64_decode($fetch['type']));
        $race_point = strtoupper(base64_decode($fetch['race_point'])); 
        $distance2 = number_format($fetch['distance']);
        $distance = $fetch['distance']; 
         $time_release = $fetch['time_release'];
        $time_arrived = $fetch['time_arrived']; 
        $time_travelled = $fetch['minutes']; 
        $resultid = $fetch['id'];
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $resultid ?>">      
      <td><?php echo $type; ?></td>
      <td><?php echo $race_point; ?></td>
      <td><?php echo $distance2; ?></td>
      <td><?php echo $time_release; ?></td>  
      <td><?php echo $time_arrived; ?></td> 
      <td><?php echo $time_travelled; ?></td>
      <td><?php echo round($distance/ $time_travelled, 3); ?></td> 
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

