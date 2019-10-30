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
    $tid = mysqli_escape_string($db, $_GET["rfid_id"]);   

    $trquery = "select * from training where uid = '$id' and id = '$tid'";
    $trresult = mysqli_query($db,$trquery);
    $trrow = mysqli_fetch_array($trresult);
    $type = $trrow['type']; 
    $race_point = $trrow['race_point']; 
    $tdistance = number_format(calculateDistanceBetweenTwoPoints(base64_decode($trrow["coord_lat"]), base64_decode($trrow["coord_long"]), $login_lat, $login_long,'MT',true,5));
    $tdistance2 = calculateDistanceBetweenTwoPoints(base64_decode($trrow["coord_lat"]), base64_decode($trrow["coord_long"]), $login_lat, $login_long,'MT',true,5);  
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
      <strong>Distance (meters):</strong> <?php echo $tdistance;?><br>
      <strong>Date Training:</strong> <?php echo strtoupper($date_start);?><br>
      <strong>Training Expire:</strong> <?php echo strtoupper($date_expire);?><br>
      <strong>Time Release:</strong> <?php echo strtoupper($time_release);?>
  </p>

<form action="" method="post">
    <input type="text" class="form-control" placeholder="RFID code" name="rfid" autofocus><br>                    
    <button style="width: 50%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='entry_submit'>Submit</button>
  </form>  

  <h3>Result</h3>

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
  </tfoot>
    <?php                        
        // list of training result
        $dsql = "SELECT *, (TIME_TO_SEC(time_arrived) - TIME_TO_SEC(time_release))/60 as minutes FROM training_result where tid = '".$_GET['rfid_id']."' order by minutes";
        $dresult = mysqli_query($db,$dsql);
         $sno = 1;
        while($dfetch = mysqli_fetch_array($dresult)){
        $dring_nr = strtoupper($dfetch['ring_nr']);
        $dcolor = $dfetch['color']; 
        $dstrain = ucwords($dfetch['strain']);
        $dgender = $dfetch['gender'];
        $ddistance = $dfetch['distance'];  
        $dtime_arrived = $dfetch['time_arrived']; 
        $dtime_travelled = $dfetch['minutes']; 
        $dresultid = $dfetch['id'];
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $resultid ?>"> 
      <td><?php echo $sno; ?></td>     
      <td><?php echo $dring_nr; ?></td>
      <td><?php echo $dcolor; ?></td>
      <td><?php echo $dstrain; ?></td>
      <td><?php echo $dgender; ?></td>  
      <td><?php echo $dtime_arrived; ?></td> 
      <td><?php echo $dtime_travelled; ?></td>
      <td><?php echo round($ddistance/ $dtime_travelled, 3); ?></td> 
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

$rfid = mysqli_real_escape_string($db, $_POST["rfid"]);
$rtid = mysqli_escape_string($db, $_GET["rfid_id"]);
$ruid = $login_id;

$sql="select * from p_details where code = '".$rfid."'";
$res=$db->query($sql);
$row=$res->fetch_assoc();
$rpid = $row["id"];
$rring_nr = $row["ring_nr"];
$rcolor = $row["colour"];
$rstrain = ucwords($row['strain']);
$rgender = $row['gender'];
$rtype = $type;
$rrace_point = $race_point;
$rdistance = $tdistance2;
$rtime_release = $time_release;

$sql="select id from training_entries where pid = '".$rpid."' and clock = 0 and tid = '".$rtid."'";
$res=$db->query($sql);
$row=$res->fetch_assoc();
$hidid = $row["id"];

$check2=mysqli_query($db,"select * from training_entries where tid='$rtid' and code = '$rfid'");
$checkrows2=mysqli_num_rows($check2);

if($checkrows2<=0) {
//echo "<script type= 'text/javascript'>alert('No entry for this rfid code!');</script>";
echo "<meta http-equiv='refresh' content='0'>";
} else
{


if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}

    

   $check=mysqli_query($db,"select tid, pid from training_result where tid='$rtid' and pid='$rpid'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    //echo "<script type= 'text/javascript'>alert('Code/ Pigeon was already clocked!');</script>";
    echo "<meta http-equiv='refresh' content='0'>";
   } else {  

    //insert training
    $sql = 'INSERT INTO training_result (uid, tid, pid, type, race_point, distance, time_release, time_arrived, ring_nr, color, strain, gender, code) VALUES ("'.$ruid.'","'.$rtid.'","'.$rpid.'","'.$rtype.'","'.$rrace_point.'","'.$rdistance.'","'.$rtime_release.'", SYSDATE(),"'.$rring_nr.'","'.$rcolor.'","'.$rstrain.'","'.$rgender.'","'.$rfid.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');

    //insert training
    $sql2 = "UPDATE training_entries SET clock = 1 where id = '$hidid'";     
    $result2 = mysqli_query($db, $sql2) or die('Error querying database.');

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