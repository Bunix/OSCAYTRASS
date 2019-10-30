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
function calculateDistanceBetweenTwoPoints($latitudeOne='', $longitudeOne='', $latitudeTwo='', $longitudeTwo='',$distanceUnit ='',$round=false,$decimalPoints='')
    {
        if (empty($decimalPoints)) 
        {
            $decimalPoints = '3';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }

        if (empty($latitudeOne)) {
            $latitudeOne = 1;
        }

        if (empty($longitudeOne)) {
            $longitudeOne = 1;
        }

        if (empty($latitudeTwo)) {
            $latitudeTwo = 1;
        }

        if (empty($longitudeTwo)) {
            $longitudeTwo = 1;
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

<?php 

 

    $id = $login_id;
    $tid = mysqli_escape_string($db, $_GET["result_id"]);   

    $trquery = "select * from other_race where cid = '$login_club' and id = '$tid'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $type = $trrow['type']; 
    $race_point = $trrow['race_point']; 
    $date_start = $trrow['date_start']; 
    $date_expire = $trrow['date_expire'];
    $time_release = $trrow['time_release']; 
    $coord = base64_decode($trrow['coord_lat']).', '.base64_decode($trrow['coord_long']) ;
    $rid = $trrow['id'];
    $race_lat = base64_decode($trrow['coord_lat']);
    $race_lon = base64_decode($trrow['coord_long']);

    $club_loc_query ="SELECT coord_lat, coord_long FROM club where id = '$login_club'";  
    $club_result = mysqli_query($db, $club_loc_query);
    $club_row = mysqli_fetch_array($club_result);

   
  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="club">Home</a></li>
        <li><a href="list-other-race">Back</a></li>
    </div>
  </div>
</nav>
    
<div class="container-fluid" style="margin-left: 20px;">

    <strong>Type:</strong> <?php echo strtoupper(base64_decode($type));?><br>
      <strong>Race Point:</strong> <?php echo strtoupper(base64_decode($race_point));?> <br>

      <strong>Coordinate (Lat, Long):</strong> <?php echo strtoupper($coord);?><br>
      <strong>Map:</strong> <a href="https://www.google.com/maps/place/'<?php echo base64_decode($trrow["coord_lat"]);?>,<?php echo base64_decode($trrow['coord_long'])?>'" target="_blank" class="trigger-btn" >View</a><br>
      
      <strong>Distance (meters):</strong> <?php echo number_format(calculateDistanceBetweenTwoPoints(base64_decode($club_row["coord_lat"]), base64_decode($club_row["coord_long"]), base64_decode($trrow["coord_lat"]), base64_decode($trrow['coord_long']),'MT',true,5));?><br>

      <strong>Date Training:</strong> <?php echo strtoupper($date_start);?><br>
      <strong>Training Expire:</strong> <?php echo strtoupper($date_expire);?><br>
      <strong>Time Release:</strong> <?php echo strtoupper($time_release);?>
  </p>
<?php 
$countquery = "select count(rid) as crid from other_race_entries where rid = '".$_GET['result_id']."'";
$trresult = mysqli_query($db,$countquery);
$trrow = mysqli_fetch_array($trresult);

$countquery2 = "select count(rid) as crid from other_race_entries where rid = '".$_GET['result_id']."' and clock = 1";
$trresult2 = mysqli_query($db,$countquery2);
$trrow2 = mysqli_fetch_array($trresult2);
?>

  <p><STRONG>Entries -> </STRONG><?php echo $trrow['crid']; ?> <STRONG>Clocked -> </STRONG><?php echo $trrow2['crid']; ?></p>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Rank</th>
      <th>Ring Nr</th>
      <th>Name</th>  
      <th>Loft Name</th> 
      <th>Coordinate (Lat, Long)</th> 
      <th>Map</th> 
      <th>Distance</th>
      <th>Code</th>  
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th>                                                                  
    </tr>
  </thead>
  <tfoot>
      <th>Rank</th>
      <th>Ring Nr</th>
      <th>Name</th>  
      <th>Loft Name</th> 
      <th>Coordinate (Lat, Long)</th> 
      <th>Map</th> 
      <th>Distance</th>
      <th>Code</th>  
      <th>Time Arrived</th>
      <th>Travelled in minutes</th>    
      <th>Speed (mpm)</th>                                                                   
  </tfoot>
    <?php                        
        // list of training result
       $dsql = "SELECT *, (TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60 as minutes, distance/((TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60) as speed FROM other_race_result where rid = '".$_GET['result_id']."' and cid = '".$login_club."' order by speed desc";
        $dresult = mysqli_query($db,$dsql);
         $sno = 1;

        while($dfetch = mysqli_fetch_array($dresult)){
        $dring_nr = strtoupper(base64_decode($dfetch['ring_nr']));
        $dmember_name = ucwords(base64_decode($dfetch['name']));
        $dmember_loft_name = strtoupper(base64_decode($dfetch['loft_name']));
        $dmember_lat = base64_decode($dfetch['my_coord_lat']);
        $dmember_lon = base64_decode($dfetch['my_coord_long']);
        $dcode = base64_decode($dfetch['code']);
        $dtime_arrived = $dfetch['time_arrived']; 
        $dtime_travelled = $dfetch['minutes']; 
        $dresultid = $dfetch['id'];
        $ddistance = $dfetch['distance'];
        $dspeed = $dfetch['speed']; 
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $resultid ?>"> 
      <td><?php echo $sno; ?></td>     
      <td><?php echo $dring_nr; ?></td>
      <td><?php echo $dmember_name; ?></td>
      <td><?php echo $dmember_loft_name; ?></td> 
      <td><?php echo $dmember_lat.', '.$dmember_lon; ?></td>  
      <td><a href="https://www.google.com/maps/place/<?php echo $dmember_lat.','.$dmember_lon;?>" target="_blank" class="trigger-btn" >View</a></td> 
      <td><?php echo number_format($ddistance);?></td>
      <td><?php echo $dcode; ?></td>
      <td><?php echo $dtime_arrived; ?></td> 
      <td><?php echo $dtime_travelled; ?></td>
      <td><?php echo round($dspeed, 3); ?></td> 
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $dresultid; ?>> </td>   
    </tr>
    
  </tbody>
</form>
  <?php
    $sno++;}
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

