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
<?php 

     $tid = mysqli_escape_string($db, $_GET["rfid_id"]);   

    $trquery = "select * from other_race where cid = '$cid' and id = '$tid'";
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

    $club_loc_query ="SELECT coord_lat, coord_long FROM club where id = '$cid'";  
    $club_result = mysqli_query($db, $club_loc_query);
    $club_row = mysqli_fetch_array($club_result);
   
  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
    </div>
  </div>
</nav>
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

<form action="" method="post">
    <input type="text" class="form-control" placeholder="Sticker code or RFID code" name="rfid" autofocus><br>                    
    <button style="width: 50%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='entry_submit'>Submit</button>
  </form>  

  <h3>Result</h3>

<div class="container-fluid">
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
        $dsql = "SELECT *, (TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60 as minutes, distance/((TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60) as speed FROM other_race_result where rid = '".$_GET['rfid_id']."' and cid = '".$cid."' order by speed desc";
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

<?php
if(isset($_POST['entry_submit'])) {

$rfid = mysqli_real_escape_string($db, base64_encode($_POST["rfid"]));
$rrid = mysqli_escape_string($db, $_GET["rfid_id"]);
$rcid = $cid;
$ruid = $login_id;

$sql="select * from other_race_entries where code = '".$rfid."' and rid = '".$rrid."' and cid = '".$rcid."'";
$res=$db->query($sql);
$row=$res->fetch_assoc();
$entry_id = $row["id"];
$entry_ring_nr = $row["ring_nr"];
$entry_cid = $row['cid'];
$entry_loft = $row['loft_name'];
$entry_name = $row['name'];
$entry_lat = $row['coord_lat'];
$entry_long = $row['coord_long'];

$sql3="select * from other_race where cid = '".$rcid."' and id = '".$rrid."'";
$res3=$db->query($sql3);
$row3=$res3->fetch_assoc();
$r_id = $row3["id"];
$r_type = $row3["type"];
$r_point = $row3["race_point"];
$r_lat = $row3["coord_lat"];
$r_lon = $row3["coord_long"];
$r_time_release = $row3["time_release"];
$r_cid = $row3['cid'];

$sql4="select * from club where id = '".$rcid."'";
$res4=$db->query($sql4);
$row4=$res4->fetch_assoc();
$c_id = $row4["id"];
$c_club = $row4["club_acronym"];

$sql5="select id from other_race_entries where rid = '".$rrid."' and clock = 0 and cid = '".$rcid."'";
$res5=$db->query($sql5);
$row5=$res5->fetch_assoc();
$hidid = $row5["id"];

$check2=mysqli_query($db,"select * from other_race_entries where rid='".$rrid."' and cid = '".$rcid."' and code = '".$rfid."'");
$checkrows2=mysqli_num_rows($check2);

if($checkrows2<=0) {
//echo "<script type= 'text/javascript'>alert('No entry for this rfid code!');</script>";
echo "<meta http-equiv='refresh' content='0'>";
} else
{


if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}

    

   $check=mysqli_query($db,"select rid, cid from other_race_result where rid='".$rrid."' and cid='".$rcid."' and code = '".$rfid."'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    //echo "<script type= 'text/javascript'>alert('Code/ Pigeon was already clocked!');</script>";
    echo "<meta http-equiv='refresh' content='0'>";
   } else {  

  $mem_distance = calculateDistanceBetweenTwoPoints(base64_decode($r_lat), base64_decode($r_lon), base64_decode($entry_lat), base64_decode($entry_long),'MT',true,5);
    //insert race result
    $sql6 = 'INSERT INTO other_race_result (uid, cid, rid, ring_nr, club, type, race_point, pt_coord_lat, pt_coord_long, name, loft_name, my_coord_lat, my_coord_long, time_release, time_arrived, distance, code) VALUES ("'.$ruid.'","'.$rcid.'","'.$rrid.'","'.$entry_ring_nr.'","'.$c_club.'","'.$r_type.'","'.$r_point.'", "'.$r_lat.'", "'.$r_lon.'", "'.$entry_name.'", "'.$entry_loft.'", "'.$entry_lat.'", "'.$entry_long.'", "'.$r_time_release.'", SYSDATE(), "'.$mem_distance.'", "'.$rfid.'")';
     
    $result6 = mysqli_query($db, $sql6) or die('Error querying database.');

    //insert training
    $sql7 = "UPDATE other_race_entries SET clock = 1 where id = '".$hidid."'";     
    $result7 = mysqli_query($db, $sql7) or die('Error querying database.');

    //echo "<script type= 'text/javascript'>alert('Pigeon Clock Submitted Successfully!');</script>";  
    echo "<meta http-equiv='refresh' content='0'>";


    mysqli_close($db);
   }
 }}
?>



 </body>
</html>

<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

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