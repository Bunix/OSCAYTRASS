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

    $tid = mysqli_escape_string($db, $_GET["list_race"]);   

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
        <li><a href="#Entry" class="btn trigger-btn" data-toggle="modal">Add Entry</a></li>
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
$no_race_query ="SELECT count(rid) as entry FROM other_race_entries where cid = $login_club and rid = '".$_GET['list_race']."'";  
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
      <th>Action</th>
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
      <th>Action</th>
  </tfoot>
    <?php                        
        // list of entries
        $sql = "SELECT * FROM other_race_entries where rid = '".$_GET['list_race']."' and cid = '".$login_club."'";
        $result = mysqli_query($db,$sql);
         $sno = 1;
        while($fetch = mysqli_fetch_array($result)){
        $ring_nr = strtoupper(base64_decode($fetch['ring_nr']));
        $loft = strtoupper(base64_decode($fetch['loft_name'])); 
        $mem_name = ucwords(base64_decode($fetch['name'])); 
        $lat = base64_decode($fetch['coord_lat']);
        $lon = base64_decode($fetch['coord_long']);
        $aid = $fetch['id'];
        $code = $fetch['code'];
       
    ?>
<form>
  <tbody>
    <tr class="delete_mem<?php echo $aid ?>"> 
      <td><?php echo $sno; ?></td>     
      <td><?php echo $ring_nr; ?></td>
      <td><?php echo $loft; ?></td>
      <td><?php echo $mem_name; ?></td>
      <td><?php echo $lat.', '.$lon; ?></td>
      <td><a href="https://www.google.com/maps/place/<?php echo $lat.','.$lon;?>" target="_blank" class="trigger-btn" >View</a></td>    
      <td hidden align='center'><input type="text" name="hiddenid" value=<?php echo $aid; ?>> </td>
      <td><?php echo number_format(calculateDistanceBetweenTwoPoints($race_lat, $race_lon, $lat, $lon,'MT',true,5));?></td>
      <td><input type="password" disabled name="code" value="<?php echo $code; ?>"></td>
      <td > 
           <a style="padding-left: 10px;" id="<?php echo $aid; ?>" class="btn btn-danger btn-xs">Delete </a>
      </td> 
    </tr>
    
  </tbody>
</form>
  <?php
   $sno++; }
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
                    url: "delete_other_race_entry.php",
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

<!-- Modal entry -->
<div id="Entry" class="modal fade">
  <div class="modal-dialog">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                  <button style="position: absolute;top: 10px; right: 40px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                  <div class="modal-body">
                     <form action="insert-other-race-entries-mem" method="post">
                      <!-- start div ring nr-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Ring Nr:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="ring" type="text" required="required" placeholder="Insert Pigeon Ring Nr" />    <br>     
                              </div>        
                          </div>
                      <!-- close div ring nr--> 
                      
                      <!-- start div loft-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Loft Name:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="loft" type="text" required="required" placeholder="Insert Loft Name" />    <br>     
                              </div>        
                          </div>
                      <!-- close div loft--> 

                      <!-- start div name-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Name:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="name" type="text" required="required" placeholder="Insert Name of Player" />    <br>     
                              </div>        
                          </div>
                      <!-- close div name--> 

                      <!-- start div lat-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Coord Lat:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="lat" type="text" required="required" placeholder="Insert Coordinate Latitude" />    <br>     
                              </div>        
                          </div>
                      <!-- close div lat--> 

                      <!-- start div long-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Coord Long:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="long" type="text" required="required" placeholder="Insert Coordinate Longtitude" />    <br>     
                              </div>        
                          </div>
                      <!-- close div long--> 

                      <!-- start div code-->       
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Code:<label style="color: red">*</label></label>
                              <div class="col-sm-7">
                                <input class="form-control" name="code" type="password" required="required" placeholder="Insert Sticker code or RFID code" />    <br>     
                              </div>        
                          </div>
                      <!-- close div code--> 
                       <div class="form-group" hidden>
                            <input hidden class="form-control" name="rid" type="text" value=<?php echo $rid;?> />
                        </div>


                            <button style="width: 100%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='submit'>Submit</button>
                   
                          </form>                             
                        
                </div>
            </div>
        </div>
    </div>
</div>
</div>     
</div> <!---end modal entry--->

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

