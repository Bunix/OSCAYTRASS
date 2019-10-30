<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}
$query4 = "select cid from club_joined_members where uid = '$login_id'";
$result4 = mysqli_query($db,$query4);
$row4 = mysqli_fetch_array($result4);
$cid = $row4['cid'];
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

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
    </div>
  </div>
</nav>

    <h4 align="center">View Schedule</h4>

  <br />



  <?php 
    $sid = mysqli_escape_string($db, $_GET["view_id"]);    

    $query = "select * from events where id = '$sid' and uid = '".$login_id."'";

    $result = mysqli_query($db,$query);
    while ( $row = mysqli_fetch_array($result)) {
  ?>
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="" method="post">   

   <!--start div date start-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time Start:</label>
        <div class="col-sm-7">                 
                <input class="form-control" name="datetimestart" type="text" value="<?php echo $row['start_date'];?>">
                </div>                             
    </div>
    <!--close div date start-->

<!--start div date end-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date/ Time End:</label>
        <div class="col-sm-7">          
                <input class="form-control" name="datetimeend" type="text"  value="<?php echo $row['end_date'];?>"/>               
                </div>        
              </div>
    <!--close div date end-->     
    <!--start div add type-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Title:</label>
        <div class="col-sm-7">
          <input style="width: 100%;" class="form-control" type="text" name="subject" value="<?php echo $row['title'];?>"/>           
      </div>

    </div>
    <!--close div add type-->

<!--start div add type-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Details:</label>
        <div class="col-sm-7">
          <textarea style="width: 100%;" class="form-control" type="text" name="detail"><?php echo $row['description'];?></textarea>          
      </div>

    </div>
    <!--close div add type-->
      <br />
       <input hidden type="text" name="hidid" value="<?php echo $row['id']?>">
      <input style="float: left; margin-left: 40%; width: 30%; color: white;" class="btn btn-danger" type="submit" value=" Delete " name="delete" onclick="return confirm('Are you sure you want to delete event/ schedule?');"/>
    </div>
  </form>
</div>
<!--end div form-->
<?php } ?>

 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

<?php 
if(isset($_POST["delete"]))
{
 
 $delete_id = mysqli_real_escape_string($db, $_POST["hidid"]);

 $sql_query="DELETE FROM events WHERE id='".$delete_id."' and uid = '".$login_id."'";
 mysqli_query($db, $sql_query); 
 mysqli_close($db);
 header("Refresh: 0; url=member");
        
}

?>