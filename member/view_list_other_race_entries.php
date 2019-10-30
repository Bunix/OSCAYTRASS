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

    $tid = mysqli_escape_string($db, $_GET["view_entries"]);   

    $trquery = "select * from other_race where cid = '".$cid."' and id = '".$tid."'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $type = $trrow['type']; 
    $race_point = $trrow['race_point']; 
    $date_start = $trrow['date_start']; 
    $date_expire = $trrow['date_expire'];
    $time_release = $trrow['time_release']; 
    $coord = base64_decode($trrow['coord_lat']).', '.base64_decode($trrow['coord_long']) ;
    $cat_id = $trrow['cat_id'];
    $rid = $trrow['id'];
    $race_lat = base64_decode($trrow['coord_lat']);
    $race_lon = base64_decode($trrow['coord_long']);

    $club_loc_query ="SELECT coord_lat, coord_long FROM club where id = '".$cid."'";  
    $club_result = mysqli_query($db, $club_loc_query);
    $club_row = mysqli_fetch_array($club_result);
    
   
  ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
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
$no_race_query ="SELECT count(rid) as entry FROM other_race_entries where cid = '".$cid."' and rid = '".$_GET['view_entries']."'";  
$no_race_result = mysqli_query($db, $no_race_query);
$no_race_row = mysqli_fetch_array($no_race_result);
$race_entry_count = $no_race_row['entry'];
 ?>

  <h3>Entries: <strong><?php echo $race_entry_count; ?></strong></h3>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>No.</th>
      <th>Ring Nr</th>
      <th>Loft Name</th>  
      <th>Name</th>
      <th>Coordinate (Lat, Long)</th>
      <th>Map</th>
      <th>Distance (meters)</th>
      <th>Code</th>                                           
    </tr>
  </thead>
  <tfoot>
      <th>No.</th>
      <th>Ring Nr</th>
      <th>Loft Name</th>  
      <th>Name</th>
      <th>Coordinate (Lat, Long)</th>
      <th>Map</th>
      <th>Distance (meters)</th> 
      <th>Code</th>                                          
  </tfoot>
    <?php                        
        // list of entries
        $sql = "SELECT * FROM other_race_entries where rid = '".$_GET['view_entries']."' and cid = '".$cid."'";
        $result = mysqli_query($db,$sql);
         $sno = 1;
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = strtoupper(base64_decode($fetch['ring_nr']));
        $loft = strtoupper(base64_decode($fetch['loft_name'])); 
        $mem_name = ucwords(base64_decode($fetch['name'])); 
        $lat = base64_decode($fetch['coord_lat']);
        $lon = base64_decode($fetch['coord_long']);
        $aid = $fetch['aid'];
        $code = $fetch['code'];
       
    ?>
<form>
  <tbody>
    <tr> 
      <td><?php echo $sno; ?></td>     
      <td><?php echo $ring_nr; ?></td>
      <td><?php echo $loft; ?></td>
      <td><?php echo $mem_name; ?></td>
      <td><?php echo $lat.', '.$lon; ?></td>
      <td><a href="https://www.google.com/maps/place/<?php echo $lat.','.$lon;?>" target="_blank" class="trigger-btn" >View</a></td>    
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $aid; ?>> </td>
      <td><?php echo number_format(calculateDistanceBetweenTwoPoints($race_lat, $race_lon, $lat, $lon,'MT',true,5));?></td>
      <td><input type="password" disabled name="acode" value="<?php echo $code; ?>"></td>      
    </tr>
    
  </tbody>
</form>
  <?php
   $sno++; }
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

