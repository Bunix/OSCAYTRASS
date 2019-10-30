<?php 
include('session.php');
if ($login_access_id != 3) {
  header("location:../logout.php");
}

$noimage = 'no_image.png';

$query ="SELECT a.uid, a.cid, a.id as aid, a.cmid as acmid, b.id as bid, b.club_acronym as cacro, b.club_name as cname, b.address as caddress, b.contact as ccontact, b.email as cemail, b.fb_link as cfb_link, b.website as cwebsite, b.coord_long as clong, b.coord_lat as clat, b.logo as clogo FROM club_joined_members as a left join club as b on a.cid = b.id where a.uid = '$login_id'";    
$result = mysqli_query($db, $query); 


?>
<!DOCTYPE html>
<html>
 <head>
  <title>Philippine Pigeon Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
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
      <a class="navbar-brand" href="member">PPMS</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="member">Home</a></li>
        <li><a href="clubs">Refresh</a></li>
        <li><a href="#Club" class="btn trigger-btn" data-toggle="modal">Link Club</a></li>
    </div>
  </div>
</nav>

 
<!--start div Form-->
<!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800">Joined Clubs:</h1>
          <!-- DataTales -->
          <div class="card shadow mb-4">            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0"s>
                  <thead>  
                               <tr>  
                                    <th>My Club ID#</th>
                                    <th>Logo</th>
                                    <th>Acronym</th>
                                    <th>Club Name</th>
                                    <th>Address</th> 
                                    <th>Contact#</th>
                                    <th>Email</th>
                                    <th>FB</th>
                                    <th>Website</th>
                                    <th>Coordinate</th>
                                    <th>Map</th>
                                    <th>Action</th>
                               </tr>  
                          </thead>  
                          <tfoot>
                                <tr>  
                                    <th>My Club ID#</th>
                                    <th>Logo</th>
                                    <th>Acronym</th>
                                    <th>Club Name</th>
                                    <th>Address</th> 
                                    <th>Contact#</th>
                                    <th>Email</th>
                                    <th>FB</th>
                                    <th>Website</th>
                                    <th>Coordinate</th>
                                    <th>Map</th>   
                                    <th>Action</th>
                               </tr>  
                  </tfoot>
                  <form>
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                                                   
                          {  
                               $profile_photo = $row['clogo'];

                              if ($profile_photo != '') {
                                $photo = '../club/'.$row['clogo'];
                                
                              } else
                              {
                                $photo = $noimage;
                              }       
                               echo '  
                               <tr class="delete_mem'.$row["aid"].' ?>">
                               <td>'.strtoupper(base64_decode($row["acmid"])).'</td> 
                               <td style="text-align: center;"><img style="width: 60px; height: 60px; text-align: center;" src='.$photo.'>  
                                    <td>'.strtoupper(base64_decode($row["cacro"])).'</td> 
                                    <td>'.strtoupper(base64_decode($row["cname"])).'</td>  
                                    <td>'.base64_decode($row["caddress"]).'</td>  
                                    <td>'.base64_decode($row["ccontact"]).'</td>     
                                    <td>'.base64_decode($row["cemail"]).'</td>  
                                    <td><a href="'.base64_decode($row["cfb_link"]).'" class="trigger-btn" target="_blank">'.base64_decode($row["cfb_link"]).'</a></td>
                                    <td><a href="'.base64_decode($row["cwebsite"]).'" class="trigger-btn" target="_blank">'.base64_decode($row["cwebsite"]).'</a></td>                                   
                                    <td>'.base64_decode($row["clat"]).', '.base64_decode($row["clong"]).'</td>

                                    <td><a href="https://www.google.com/maps/place/'.base64_decode($row["clat"]).','.base64_decode($row["clong"]).'" target="_blank" class="trigger-btn" >View</a></td>
                                    <td>            
           <a style="width: 100%;" href="javascript:view_id('.$row["bid"].')" class="btn btn-primary btn-xs" >View</a><br><br>
           <a style="width: 100%;" id="'.$row["aid"].'" class="btn btn-danger btn-xs"> Unlink</a>
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


<!-- Modal club -->
<div id="Club" class="modal fade">
  <div class="modal-dialog">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                  <button style="position: absolute;top: 10px; right: 40px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                  <div class="modal-body">
                      <!-- start div Select sire-->       
                          <div class="form-group">   
                          <form action="insert-joined-club" method="post">
                            <label class="col-sm-3 control-label">Select Club:</label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="club" required>
                                  <option value="">--Select--</options>
                              <?php 
                                $sql="select * from club order by club_acronym";
                                $res=$db->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                  echo "<option value='{$row["id"]}'>
                                  ".base64_decode($row["club_acronym"])." | ".base64_decode($row["club_name"])."</option>";
                                }
                              ?>                
                                </select><br>
                              </div>
                              </div>
                             <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Club ID #:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="cid" type="text" required="required" placeholder="Please Enter your Club ID # from selected club"/> <br>        
        </div>        
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Security Code:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="sctycode" type="text" required="required" placeholder="Please Enter Security Code provided/ given by your selected club"/>   <br>      
        </div>        
    </div>
    <!--close div fullname-->  

    
                            <button style="width: 100%;" type="submit" class="btn btn-primary btn-sm btn-block login-btn" name='joined'>Submit</button>
                          </form>                             
                        </div>
                      <!-- close div Select sire--> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>     
</div> <!---end modal entry--->
</body>
</html>

<!-- Javascript -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
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
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to unlink to this club?")) {
                $.ajax({
                    type: "GET",
                    url: "unlink-club",
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

<script type="text/javascript">
function view_id(id)
{
        window.location.href='view-linked-club?view_id='+id+'<?php
        $codequery ="SELECT * FROM code order by rand() limit 1";  
        $coderesult = mysqli_query($db, $codequery);
        $coderow = mysqli_fetch_array($coderesult);
        $code = $coderow['code'];
        echo $code;
         ?>';
}
</script>