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

    $bid = mysqli_escape_string($db, $_GET["view_id"]);   

    $trquery = "select * from club where id = '".$bid."'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $club_acro = base64_decode($trrow['club_acronym']);
    $club_name = base64_decode($trrow['club_name']);
    $club_logo = '../club/'.$trrow['logo'];   
    $cid = $trrow['id'];
   
  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
        <li><a href="clubs">Back</a></li>
        <li><a href="javascript:view_id(<?php echo $cid;?>)">View Races for Club Members</a></li>
        <li><a href="javascript:view_other_id(<?php echo $cid;?>)">View Other Races</a></li>        
      </ul>
      
    </div>
  </div>
</nav>
<div class="container-fluid" style="text-align: center;">
  <div>
        <img style="border-radius: 50%; height: 100px; width: 100px; margin-top: 10px;" src="<?php echo $club_logo; ?>" alt="Club Logo">
      </div>  
      <h3><strong><?php echo strtoupper($club_acro); ?></strong></h3>
      <h4><strong><?php echo strtoupper($club_name);?></strong></h4>
 </div>
  
<div class="container">
  <h3>Schedules</h3>
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Date Posted</th>
      <th>Subject</th>  
      <th>Description</th> 
      <th>Date Schedule (Y-M-D Time)</th> 
    </tr>
  </thead>
  <tfoot>
      <th>Date Posted</th>
      <th>Subject</th>  
      <th>Description</th>  
      <th>Date Schedule (Y-M-D Time)</th>
  </tfoot>
    <?php                        
        // list of pigeon
        $sql = "SELECT * FROM club_schedules where cid = '".$cid."' order by id desc limit 30";
        $result = mysqli_query($db,$sql);
        while($fetch = mysqli_fetch_array($result)){
        $d_posted = $fetch['d_posted'];
        $subject = base64_decode($fetch['subject']); 
        $description = base64_decode($fetch['description']); 
        $date_sched = $fetch['start_date'].' - '.$fetch['end_date'];     
    ?>
<form>
  <tbody>
    <tr>      
      <td><?php echo $d_posted; ?></td>
      <td><?php echo $subject; ?></td>
      <td><?php echo $description; ?></td>
      <td><?php echo $date_sched; ?></td>  
    </tr>
    
  </tbody>
</form>
  <?php
    }
    ?>
</table>

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

<?php
if(isset($_POST['entry_submit'])) {

$entry = mysqli_real_escape_string($db, $_POST["entry"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO training_entries (tid, uid, pid) VALUES ("'.$tid.'","'.$login_id.'","'.$entry.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Entry Added Successfully!');</script>";  
    echo "<meta http-equiv='refresh' content='0'>";
    mysqli_close($db);
   }

?>

<?php

if(isset($_POST['delete_entry']))
{

 $sql_query="DELETE FROM training_entries WHERE pid='".$row2['id']."'";
 mysqli_query($db, $sql_query);
 //echo "<meta http-equiv='refresh' content='0'>";
}

?>

 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

<script type="text/javascript">
function view_id(id)
{
        window.location.href='list-race?view_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function view_other_id(id)
{
        window.location.href='list-other-race?view_other_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>