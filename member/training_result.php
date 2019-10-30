<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

?>
<?php
function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='')
    {
        if (empty($decimalPoints)) 
        {
            $decimalPoints = '3';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }
        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        $toNauticalMiles = $toMiles * 0.8684;
        $toMeters = $toKilometers * 1000;
        $toFeets = $toMiles * 5280;
        $toYards = $toFeets / 3;


              switch (strtoupper($distanceUnit)) 
              {
                  case 'ML'://miles
                         $toMiles  = ($round == true ? round($toMiles) : round($toMiles, $decimalPoints));
                         return $toMiles;
                      break;
                  case 'KM'://Kilometers
                        $toKilometers  = ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
                        return $toKilometers;
                      break;
                  case 'MT'://Meters
                        $toMeters  = ($round == true ? round($toMeters) : round($toMeters, $decimalPoints));
                        return $toMeters;
                      break;
                  case 'FT'://feets
                        $toFeets  = ($round == true ? round($toFeets) : round($toFeets, $decimalPoints));
                        return $toFeets;
                      break;
                  case 'YD'://yards
                        $toYards  = ($round == true ? round($toYards) : round($toYards, $decimalPoints));
                        return $toYards;
                      break;
                  case 'NM'://Nautical miles
                        $toNauticalMiles  = ($round == true ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints));
                        return $toNauticalMiles;
                      break;
              }


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
    $tid = mysqli_escape_string($db, $_GET["result_id"]);   

    $trquery = "select * from training where uid = '$id' and id = '$tid'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $type = $trrow['type']; 
    $race_point = $trrow['race_point']; 
    $distance = number_format(calculateDistanceBetweenTwoPoints(base64_decode($trrow["coord_lat"]), base64_decode($trrow["coord_long"]), $login_lat, $login_long,'MT',true,5)); 
    $date_start = $trrow['date_start']; 
    $date_expire = $trrow['date_expire'];
    $time_release = $trrow['time_release']; 
    $coord = base64_decode($trrow['coord_lat']).', '.base64_decode($trrow['coord_long']) ;
   
  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
        <li><a href="list-training">Back</a></li>
    </div>
  </div>
</nav>
    
<div class="container-fluid" style="margin-left: 20px;">
  <p><strong>Type:</strong> <?php echo strtoupper(base64_decode($type));?><br>
      <strong>Race Point:</strong> <?php echo strtoupper(base64_decode($race_point));?> <br>
      <strong>Coordinate (Lat, Long):</strong> <?php echo strtoupper($coord);?> <a href="https://www.google.com/maps/place/'<?php echo base64_decode($trrow["coord_lat"]);?>,<?php echo base64_decode($trrow['coord_long'])?>'" target="_blank" class="trigger-btn" >View</a><br>
      <strong>Distance (meters):</strong> <?php echo $distance;?><br>
      <strong>Date Training:</strong> <?php echo strtoupper($date_start);?><br>
      <strong>Training Expire:</strong> <?php echo strtoupper($date_expire);?><br>
      <strong>Time Release:</strong> <?php echo strtoupper($time_release);?>
  </p>
<?php 
$countquery = "select count(tid) as ctid from training_entries where tid = '".$_GET['result_id']."'";
$trresult = mysqli_query($db,$countquery);
$trrow = mysqli_fetch_array($trresult);

$countquery2 = "select count(tid) as ctid from training_entries where tid = '".$_GET['result_id']."' and clock = 1";
$trresult2 = mysqli_query($db,$countquery2);
$trrow2 = mysqli_fetch_array($trresult2);
?>

  <p><STRONG>Entries -> </STRONG><?php echo $trrow['ctid']; ?> <STRONG>Clocked -> </STRONG><?php echo $trrow2['ctid']; ?></p>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Rank</th>
      <th>Ring Nr</th>
      <th>Color</th>  
      <th>Strain</th>  
      <th>Gender</th>  
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th> 
      <th>Action</th>                                                                  
    </tr>
  </thead>
  <tfoot>
    <th>Rank</th>
    <th>Ring Nr</th>
      <th>Color</th>  
      <th>Strain</th>  
      <th>Gender</th>   
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th>   
      <th>Action</th>                                                                   
  </tfoot>
    <?php                        
        // list of training result
        $sql = "SELECT *, (TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60 as minutes FROM training_result where tid = '".$_GET['result_id']."' order by minutes";
        $result = mysqli_query($db,$sql);
        $sno = 1;
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = strtoupper($fetch['ring_nr']);
        $color = $fetch['color']; 
        $strain = ucwords($fetch['strain']);
        $gender = $fetch['gender'];
        $distance = $fetch['distance'];  
        $time_arrived = $fetch['time_arrived']; 
        $time_travelled = $fetch['minutes']; 
        $resultid = $fetch['id'];        
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $resultid ?>"> 
      <td><?php echo $sno; ?></td>
      <td><?php echo $ring_nr; ?></td>
      <td><?php echo $color; ?></td>
      <td><?php echo $strain; ?></td>
      <td><?php echo $gender; ?></td>  
      <td><?php echo $time_arrived; ?></td> 
      <td><?php echo $time_travelled; ?></td>
      <td><?php echo round($distance/ $time_travelled, 3); ?></td> 
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $resultid; ?>> </td>
      <td > 
           <a style="padding-left: 10px;" id="<?php echo $resultid; ?>" class="btn btn-danger btn-xs"> Delete</a>
      </td> 
    </tr>
    
  </tbody>
</form>
  <?php
    $sno++;}
    ?>
</table>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this result?")) {
                $.ajax({
                    type: "GET",
                    url: "delete_result.php",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".delete_mem" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>


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

