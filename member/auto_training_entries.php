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
    $tid = mysqli_escape_string($db, $_GET["auto_entry"]);   

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
        <li><a href="#Entry" class="btn trigger-btn" data-toggle="modal">Add Entry</a></li>
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


  <form action="" method="post">
    <input type="text" class="form-control" placeholder="RFID code" name="rfid" autofocus><br>                    
    <button style="width: 50%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='entry_submit'>Submit</button>
  </form>                 


  <h3>Entries</h3>

<div class="container">
          </label> <input type="text" class="search form-control" placeholder="Search for?"> <br />  

        <table class="table table-striped table-bordered table-sm" id="table2excel">
  <thead>
    <tr>
      <th>Ring Nr</th>
      <th>Code/ RFID</th>
      <th>Color</th>  
      <th>Strain</th>  
      <th>Gender</th>                                                                         
      <th>Action</th>
    </tr>
  </thead>
  <tfoot>
    <th>Ring Nr</th>
    <th>Code/ RFID</th>
      <th>Color</th>  
      <th>Strain</th>  
      <th>Gender</th>                                                                         
      <th>Action</th>
  </tfoot>
    <?php                        
        // list of pigeon
        $sql = "SELECT training_entries.id as entryid, training_entries.tid, training_entries.pid, training_entries.uid, training_entries.code, p_details.id, p_details.ring_nr, p_details.colour, p_details.strain, p_details.gender FROM training_entries left join p_details on training_entries.pid = p_details.id where training_entries.tid = '".$_GET['auto_entry']."'";
        $result = mysqli_query($db,$sql);
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = strtoupper($fetch['ring_nr']);
        $color = $fetch['colour']; 
        $strain = ucwords($fetch['strain']);
        $gender = $fetch['gender']; 
        $rfid = $fetch['code'];       
        $id = $fetch['entryid'];
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $id ?>">      
      <td><?php echo $ring_nr; ?></td>
      <td><?php echo $rfid; ?></td>
      <td><?php echo $color; ?></td>
      <td><?php echo $strain; ?></td>
      <td><?php echo $gender; ?></td>    
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $id; ?>> </td>
      <td > 
           <a style="padding-left: 10px;" id="<?php echo $id; ?>" class="btn btn-danger btn-xs">Delete </a>
      </td> 
    </tr>
    
  </tbody>
</form>
  <?php
    }
    ?>
</table>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this entry?")) {
                $.ajax({
                    type: "GET",
                    url: "delete_entry.php",
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

if (!$db) {
die("Connection failed: " . mysqli_connect_error());
}

$check2=mysqli_query($db,"select * from p_details where uid='".$login_id."' and code = '".$rfid."'");
$checkrows2=mysqli_num_rows($check2);

if($checkrows2<=0) {
echo "<script type= 'text/javascript'>alert('No matched for this rfid code!');</script>";
echo "<meta http-equiv='refresh' content='0'>";
} else {
  $check3=mysqli_query($db,"select * from training_entries where tid='".$tid."' and code = '".$rfid."'");
$checkrows3=mysqli_num_rows($check3);

if($checkrows3>0) {
echo "<script type= 'text/javascript'>alert('Pigeon/ RFID code already inserted!');</script>";
echo "<meta http-equiv='refresh' content='0'>";
}

else {
  $sql="select * from p_details where code = '".$rfid."'";
$res=$db->query($sql);
$row=$res->fetch_assoc();
$entry = $row["id"]; 
    //insert training
    $sql = 'INSERT INTO training_entries (tid, uid, pid, code) VALUES ("'.$tid.'","'.$login_id.'","'.$entry.'","'.$rfid.'")';
     
    $result = mysqli_query($db, $sql) or die('Error querying database.');
    echo "<script type= 'text/javascript'>alert('New Entry Added Successfully!');</script>";  
    echo "<meta http-equiv='refresh' content='0'>";
    mysqli_close($db);
   }
}


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

