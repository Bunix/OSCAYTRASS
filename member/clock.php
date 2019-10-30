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
    $tid = mysqli_escape_string($db, $_GET["clock_id"]);   

    $trquery = "select * from training where uid = '$id' and id = '$tid'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $type = $trrow['type']; 
    $race_point = $trrow['race_point']; 
    $distance = number_format(calculateDistanceBetweenTwoPoints(base64_decode($trrow["coord_lat"]), base64_decode($trrow["coord_long"]), $login_lat, $login_long,'MT',true,5)); 
    $distance2 = calculateDistanceBetweenTwoPoints(base64_decode($trrow["coord_lat"]), base64_decode($trrow["coord_long"]), $login_lat, $login_long,'MT',true,5);
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

  <h3>Entries (Clock Manual)</h3>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Ring Nr</th>
      <th>Date Arrived</th>   
      <th>Time Arrived (Hour:Minutes AM/PM)</th>                                                                          
      <th>Action</th>
    </tr>
  </thead>
  <tfoot>
      <th>Ring Nr</th>
      <th>Date Arrived</th>   
      <th>Time Arrived (Hour:Minutes AM/PM)</th>                                                                        
      <th>Action</th>
  </tfoot>
    <?php                        
        // list of pigeon
        $sql = "SELECT training_entries.id as entryid, training_entries.tid as entrytid, training_entries.pid, training_entries.uid, p_details.id, p_details.ring_nr, p_details.colour, p_details.strain, p_details.gender FROM training_entries left join p_details on training_entries.pid = p_details.id where training_entries.clock = 0 and training_entries.tid = '".$_GET['clock_id']."'";
        $result = mysqli_query($db,$sql);
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = strtoupper($fetch['ring_nr']);
        $color = $fetch['colour']; 
        $strain = ucwords($fetch['strain']);
        $gender = $fetch['gender'];        
        $id = $fetch['entryid'];
        $pid = $fetch['id'];
        $tid = $fetch['entrytid'];
    ?>
  <form action="" method="post">
  <tbody>
    <tr>      
      <td><?php echo $ring_nr; ?></td>
      <td><input type="date" name="datearrived"></td>
      <td><input type="time" name="timearrived"></td>
      <td hidden><input type="text" name="uid" value="<?php echo $login_id; ?>"> </td>
      <td hidden><input type="text" name="pid" value="<?php echo $pid; ?>"> </td>
      <td hidden><input type="text" name="tid" value="<?php echo $tid; ?>"> </td>
      <td hidden><input type="text" name="ring_nr" value="<?php echo $ring_nr; ?>"> </td>
      <td hidden><input type="text" name="color" value="<?php echo $color; ?>"> </td>
      <td hidden><input type="text" name="strain" value="<?php echo $strain; ?>"> </td>
      <td hidden><input type="text" name="gender" value="<?php echo $gender; ?>"> </td>
      <td hidden><input type="text" name="type" value="<?php echo $type;?>"> </td>
      <td hidden><input type="text" name="race_point" value="<?php echo $race_point;?>"> </td>
      <td hidden><input type="text" name="distance" value="<?php echo $distance2;?>"> </td>
      <td hidden><input type="text" name="timerelease" value="<?php echo strtoupper($time_release);?>"> </td>
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $id; ?>> </td>
      <td > 
        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-xs">
      </td> 
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

<?php
if(isset($_POST['submit'])) {

$rtype = mysqli_real_escape_string($db, $_POST["type"]);
$race_point = mysqli_real_escape_string($db, $_POST["race_point"]);
$distance = mysqli_real_escape_string($db, $_POST["distance"]);
$date_release = mysqli_real_escape_string($db, $_POST["timerelease"]);
$date_arrived = mysqli_real_escape_string($db, $_POST["datearrived"]);
$time_arrived = mysqli_real_escape_string($db, $_POST["timearrived"]);
$date_time_arrived = $date_arrived.' '.$time_arrived;
$ruid = mysqli_real_escape_string($db, $_POST["uid"]);
$rpid = mysqli_real_escape_string($db, $_POST["pid"]);
$rtid = mysqli_real_escape_string($db, $_POST["tid"]);
$rring_nr = mysqli_real_escape_string($db, $_POST["ring_nr"]);
$rcolor = mysqli_real_escape_string($db, $_POST["color"]);
$rstrain = mysqli_real_escape_string($db, $_POST["strain"]);
$rgender = mysqli_real_escape_string($db, $_POST["gender"]);

$hidid = mysqli_real_escape_string($db, $_POST["hiddenid"]);

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}
      
    //insert training
    $sql = 'INSERT INTO training_result (uid, tid, pid, type, race_point, distance, time_release, time_arrived, ring_nr, color, strain, gender) VALUES ("'.$ruid.'","'.$rtid.'","'.$rpid.'","'.$rtype.'","'.$race_point.'","'.$distance.'","'.$date_release.'","'.$date_time_arrived.'","'.$rring_nr.'","'.$rcolor.'","'.$rstrain.'","'.$rgender.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');

    //insert training
    $sql2 = "UPDATE training_entries SET clock = 1 where id = '$hidid'";     
    $result2 = mysqli_query($db, $sql2) or die('Error querying database.');

    echo "<script type= 'text/javascript'>alert('Pigeon Clock Submitted Successfully!');</script>";  
    echo "<meta http-equiv='refresh' content='0'>";


    mysqli_close($db);
   }

?>



 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

