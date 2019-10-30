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

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
        <li><a href="archive">Back</a></li>
    </div>
  </div>
</nav>
    

  <?php 

    $id = $login_id;
    $pid = mysqli_escape_string($db, $_GET["pigeon"]);
    $query = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and id ='$pid'";

    $result = mysqli_query($db,$query);

    while ( $row = mysqli_fetch_array($result)) {
      $sire_ring = $row['sire_ring_nr'];
      $dam_ring = $row['dam_ring_nr'];
  ?>

<div class="container-fluid">
  <div class="row">

  <div class="col-sm-4">      

    <div class="card" style="width:400px;">
  <img class="card-img-top" src="pigeon_pic/<?php echo $row['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($row['ring_nr'])?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($row['name'])?></strong><br>
        Color: <strong><?php echo ucwords($row['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($row['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($row['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($row['datehatched'])?></strong><br>
        Remarks: <?php echo $row['remarks']?>
      </p>
    <a href="#Primary" class="btn btn-primary" data-toggle="modal">See Details</a><br /><br />
    <a href="#Primary" class="btn btn-primary" data-toggle="modal">See Progeny</a>
  </div>
</div>

  </div><!---end-col-sm-4-->

  <div class="col-sm-4">

      <div>
        <h4>Sire</h4>
      </div>
      <div class="card" style="width:400px;">
        <?php 
      $sirequery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr = '$sire_ring'";

      $sireresult = mysqli_query($db,$sirequery);
      $sirerow = mysqli_fetch_array($sireresult);
      $grandsire = $sirerow['sire_ring_nr'];
      $granddam = $sirerow['dam_ring_nr'];
    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $sirerow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($sirerow['ring_nr'])?></h4>
    
    <p class="card-text">Name: <strong><?php echo ucwords($sirerow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($sirerow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($sirerow['strain'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($sirerow['datehatched'])?></strong><br>
        Remarks: <?php echo $sirerow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $sirerow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>

      <!----grand sire and dam --->
      <div class="container-fluid">
      <div class="row">
        <div class="col">
                <div>
                  <h4>Grand Sire</h4>
                </div>
      <div class="card" style="width:400px;">
        <?php 
      $grandsirequery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr ='$grandsire'";

      $grandsireresult = mysqli_query($db,$grandsirequery);
      $grandsirerow = mysqli_fetch_array($grandsireresult);
    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $grandsirerow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($grandsirerow['ring_nr']);?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($grandsirerow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($grandsirerow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($grandsirerow['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($grandsirerow['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($grandsirerow['datehatched'])?></strong><br>
        Remarks: <?php echo $grandsirerow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $grandsirerow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>
        
        <div class="col">
              <div>
                <h4>Grand Dam</h4>
              </div>
      <div class="card" style="width:400px;">
        <?php 
      $granddamquery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr ='$granddam'";

      $granddamresult = mysqli_query($db,$granddamquery);
      $granddamrow = mysqli_fetch_array($granddamresult);
    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $granddamrow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($granddamrow['ring_nr'])?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($granddamrow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($granddamrow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($granddamrow['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($granddamrow['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($granddamrow['datehatched'])?></strong><br>
        Remarks: <?php echo $granddamrow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $granddamrow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>
      
      </div><!----end grand sire and dam --->     
</div>
  </div><!---end-col-sm-4-->

<!------End Sire ---->

 
</div> 
</div>
<!---start Dam---->   

  <div class="col-sm-4">

      <div>
        <h4>Dam</h4>
      </div>
      <div class="card" style="width:400px;">
        <?php 
      $damquery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr ='$dam_ring'";

      $damresult = mysqli_query($db,$damquery);
      $damrow = mysqli_fetch_array($damresult);
      $damgrandsire = $damrow['sire_ring_nr'];
      $damgranddam = $damrow['dam_ring_nr'];

    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $damrow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($damrow['ring_nr'])?></h4>
    
    <p class="card-text">Name: <strong><?php echo ucwords($damrow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($damrow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($damrow['strain'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($damrow['datehatched'])?></strong><br>
        Remarks: <?php echo $damrow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $damrow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>

      <!----grand sire and dam --->
      <div class="container-fluid">
      <div class="row">
        <div class="col">
                <div>
                  <h4>Grand Sire</h4>
                </div>
      <div class="card" style="width:400px;">
        <?php 
      $damgrandsirequery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr ='$damgrandsire'";

      $damgrandsireresult = mysqli_query($db,$damgrandsirequery);
      $damgrandsirerow = mysqli_fetch_array($damgrandsireresult);
    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $damgrandsirerow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($damgrandsirerow['ring_nr']);?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($damgrandsirerow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($damgrandsirerow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($damgrandsirerow['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($damgrandsirerow['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($damgrandsirerow['datehatched'])?></strong><br>
        Remarks: <?php echo $damgrandsirerow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $damgrandsirerow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>
        
        <div class="col">
              <div>
                <h4>Grand Dam</h4>
              </div>
      <div class="card" style="width:400px;">
        <?php 
      $damgranddamquery = "select *, date_format(date_hatched, '%e-%b-%y') as datehatched from p_details where uid = '$id' and ring_nr ='$damgranddam'";

      $damgranddamresult = mysqli_query($db,$damgranddamquery);
      $damgranddamrow = mysqli_fetch_array($damgranddamresult);
    ?>
  <img class="card-img-top" src="pigeon_pic/<?php echo $damgranddamrow['photo'];?>" style="width: 200px; height: 200px;" alt="Pigeon image">
  <div class="card-body">
    <h4 class="card-title"><?php echo strtoupper($damgranddamrow['ring_nr'])?></h4>
    <p class="card-text">Name: <strong><?php echo ucwords($damgranddamrow['name'])?></strong><br>
        Color: <strong><?php echo ucwords($damgranddamrow['colour'])?></strong><br>
        Strain: <strong><?php echo ucwords($damgranddamrow['strain'])?></strong><br>
        Gender: <strong><?php echo ucwords($damgranddamrow['gender'])?></strong><br>
        Date Hatched: <strong><?php echo ucwords($damgranddamrow['datehatched'])?></strong><br>
        Remarks: <?php echo $damgranddamrow['remarks']?>
      </p>
    <a href="javascript:pigeon(<?php echo $damgranddamrow['id']?>)" class="btn btn-primary trigger-btn">See Details</a>
  </div>
</div><br>
      
      </div><!----end grand sire and dam --->     
</div>
  </div><!---end-col-sm-4-->
  <!---End Dam ---->

<!--end div form-->

<!-- Modal profile -->
<div id="Primary" class="modal fade">
  <div class="modal-dialog">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                  <button style="position: absolute;top: 10px; right: 40px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                    <div class="col-sm-6 col-md-4">
                        <img style="height: 150px; width: 150px; border-color: black;" src="pigeon_pic/<?php echo $row['photo']; ?>" alt="Pigeon Photo" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h3><?php echo strtoupper($row['ring_nr']); ?></h3>
                        <p style="text-align: left;">
                        <strong> Name: </strong><?php echo strtoupper($row['name']); ?><br>
                        <strong>Color:</strong> <?php echo ucwords($row['colour']); ?><br>
                        <strong>Strain:</strong>  <?php echo ucwords($row['strain']); ?><br>
                        <strong>Gender: </strong> <?php echo ucwords($row['gender']); ?><br>
                        <strong>Date Hatched: </strong> <?php echo $row['datehatched']; ?><br>
                        <strong>Remarks: </strong>  <?php echo ucwords($row['remarks']); ?><br>
                        </p> 
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>     
</div> <!---end profile--->
<?php } ?>
  </div>

 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

        <script type="text/javascript">
function pigeon(id)
{
        window.location.href='view-archive-pigeon?pigeon='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>