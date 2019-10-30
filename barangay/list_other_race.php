<?php 
include('session.php');
if ($login_access_id != 2) {
  header("location:../logout.php");
}

if(isset($_GET['delete_id']))
{
$delete_id = mysqli_real_escape_string($db, $_GET["delete_id"]);

 $sql_query="DELETE FROM other_race WHERE id='".$delete_id."'";
 mysqli_query($db, $sql_query);

 $sql_query2="DELETE FROM other_race_entries WHERE rid='".$delete_id."'";
 mysqli_query($db, $sql_query2);

 $sql_query3="DELETE FROM other_race_result WHERE rid='".$delete_id."'";
 mysqli_query($db, $sql_query3);
 header("Location: list-other-race");
}

$query ="SELECT * FROM other_race where cid = $login_club and date_expire > sysdate() order by id desc";  
$result = mysqli_query($db, $query); 
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
      <a class="navbar-brand" href="club">PPMS</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="club">Home</a></li>
        <li><a href="add-other-race">Add Race Schedule</a></li>
        <li><a href="list-other-race">Refresh</a></li>
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
        if (empty($longitudeOne)) {
            $longitudeOne = '0';
        }
        if (empty($latitudeOne)) {
            $latitudeOne = '0';
        }
        if (empty($longitudeTwo)) {
            $longitudeTwo = '0';
        }
        if (empty($latitudeTwo)) {
            $latitudeTwo = '0';
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

<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 style="text-align: center;" class="h3 mb-2 text-gray-800">List of Other Race Schedule</h1>
          <h4 class="h4 mb-2 text-gray-800">Active Race Schedule</h4>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Type</th>
                                    <th>Race Point</th>  
                                    <th>Coordinate (Lat, Long)</th>
                                    <th>Map</th>
                                    <th>Distance (meters)</th>
                                    <th>Date Start</th> 
                                    <th>Date Expire</th> 
                                    <th>Time Release</th>  
                                    <th># of Entries</th>
                                    <th>Entries</th> 
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Type</th>
                                    <th>Race Point</th> 
                                    <th>Coordinate (Lat, Long)</th>
                                    <th>Map</th>
                                    <th>Distance (meters)</th> 
                                    <th>Date Start</th>  
                                     <th>Date Expire</th>
                                    <th>Time Release</th>  
                                    <th># of Entries</th> 
                                    <th>Entries</th> 
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))                            
                          {  
                             $noquery ="SELECT count(rid) as entry FROM other_race_entries where cid = $login_club and rid = '".$row["id"]."'";  
                              $noresult = mysqli_query($db, $noquery);
                              $norow = mysqli_fetch_array($noresult);
                              
                              $club_loc_query ="SELECT coord_lat, coord_long FROM club where id = $login_club";  
                                $club_result = mysqli_query($db, $club_loc_query);
                                $club_row = mysqli_fetch_array($club_result);       
         
                               echo '  
                               <tr>  
                                    <td>'.strtoupper(base64_decode($row["type"])).'</td>  
                                    <td>'.ucwords(base64_decode($row["race_point"])).'</td>  
                                    <td>'.base64_decode($row["coord_lat"]).', '.base64_decode($row["coord_long"]).'</td>

                                    <td><a href="https://www.google.com/maps/place/'.base64_decode($row["coord_lat"]).','.base64_decode($row["coord_long"]).'" target="_blank" class="trigger-btn" >View</a></td>

                                    <td>'.number_format(calculateDistanceBetweenTwoPoints(base64_decode($club_row["coord_lat"]), base64_decode($club_row["coord_long"]), base64_decode($row["coord_lat"]), base64_decode($row["coord_long"]),'MT',true,5)).'</td>  
                                    <td>'.$row["date_start"].'</td>
                                    <td>'.$row["date_expire"].'</td>  
                                    <td>'.$row["time_release"].'</td>
                                    <td style="text-align: center;">'.$norow["entry"].'</td>
                                    <td>
            <a href="javascript:list_race('.$row["id"].')" class="trigger-btn" >View</a><br>
                                    </td>                                    
                                    <td>
            <a href="javascript:result_id('.$row["id"].')" class="trigger-btn" >Result</a><br> 
           <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Delete </a>
                                    </td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                          </form>
                </table>
              </div>
            </div>
          </div>
<br>
          <h4 class="h4 mb-2 text-gray-800">Expired Race Schedule</h4>
          <?php 
          $query ="SELECT * FROM other_race where cid = $login_club and date_expire < sysdate() order by date_expire desc";  
          $result = mysqli_query($db, $query);   ?>

          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable2" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>Type</th>
                                    <th>Race Point</th>  
                                    <th>Coordinate (Lat, Long)</th>
                                    <th>Map</th>
                                    <th>Distance (meters)</th>
                                    <th>Date Start</th> 
                                    <th>Date Expire</th> 
                                    <th>Time Release</th>  
                                    <th># of Entries</th>
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>Type</th>
                                    <th>Race Point</th>  
                                    <th>Coordinate (Lat, Long)</th>
                                    <th>Map</th>
                                    <th>Distance (meters)</th>
                                    <th>Date Start</th> 
                                    <th>Date Expire</th> 
                                    <th>Time Release</th>  
                                    <th># of Entries</th>
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))                            
                          {  
                             
                          $noquery ="SELECT count(rid) as entry FROM other_race_entries where cid = $login_club and rid = '".$row["id"]."'";  
                                    $noresult = mysqli_query($db, $noquery);
                                    $norow = mysqli_fetch_array($noresult);

                                    $club_loc_query ="SELECT coord_lat, coord_long FROM club where id = $login_club";  
                                $club_result = mysqli_query($db, $club_loc_query);
                                $club_row = mysqli_fetch_array($club_result);

                               echo '  
                               <tr>  
                                    <td>'.strtoupper(base64_decode($row["type"])).'</td>  
                                    <td>'.ucwords(base64_decode($row["race_point"])).'</td>  
                                    <td>'.base64_decode($row["coord_lat"]).', '.base64_decode($row["coord_long"]).'</td>

                                    <td><a href="https://www.google.com/maps/place/'.base64_decode($row["coord_lat"]).','.base64_decode($row["coord_long"]).'" target="_blank" class="trigger-btn" >View</a></td>

                                    <td>'.number_format(calculateDistanceBetweenTwoPoints(base64_decode($club_row["coord_lat"]), base64_decode($club_row["coord_long"]), base64_decode($row["coord_lat"]), base64_decode($row["coord_long"]),'MT',true,5)).'</td>  
                                    <td>'.$row["date_start"].'</td>
                                    <td>'.$row["date_expire"].'</td>  
                                    <td>'.$row["time_release"].'</td>
                                    <td style="text-align: center;"><a href="javascript:view_entries('.$row["id"].')" class="trigger-btn" >'.$norow["entry"].'</a></td>
                                    <td>
            <a href="javascript:result_id('.$row["id"].')" class="trigger-btn" >Result</a><br> 
           <a href="javascript:delete_id('.$row["id"].')" class="trigger-btn" >Delete </a>
                                    </td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                          </form>
                </table>
              </div>
            </div>
          </div>

        

        </div>
        <!-- /.container-fluid -->

</body>
</html>

<!-- Javascript -->
        
        <script src="jquery-3.3.1.js"></script>
        <script src="jquery.dataTables.min.js"></script>
        <script src="dataTables.bootstrap.min.js"></script>
<!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable2').DataTable();
} );
</script>

<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Race Record?'))
     {
        window.location.href='list-other-race?delete_id='+id;
     }
}
</script>

<script type="text/javascript">
function list_race(id)
{
        window.location.href='list-other-race-entries?list_race='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function view_entries(id)
{
        window.location.href='view-list-other-race-entries?view_entries='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>

<script type="text/javascript">
function result_id(id)
{
        window.location.href='other-race-result?result_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>