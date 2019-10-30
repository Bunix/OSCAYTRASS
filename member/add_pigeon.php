<?php 
include('session.php');
 if ($login_access_id != 3) {
  header("location:../logout.php");
}

?>

<html lang="en">
<head>

<title>Philippine Pigeon Management System</title>
<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <script src="../jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>  
 <link rel="shortcut icon" href="../assets/ico/favicon.png">

<!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
<script type="text/javascript" src="formden.js"></script>

<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="bootstrap-iso.css" />


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
      <a class="navbar-brand" href="member"><?php echo strtoupper($login_loft); ?></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="member">Home</a></li>        
      </ul><!--end nav-barnav-->            
    </div><!---myNavbar-->
  </div><!---container-fluid-->
</nav>  

<!--start div Form-->
<div class="container">  
	<h3>Add <b>Pigeon</b></h3> 
  <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>
  <br>
   <form class="form-horizontal" action="insert-pigeon" method="post">
    
    <!--start div add Ring Nr-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Ring Number:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: uppercase;" class="form-control" type="text" name="ring" required="required" placeholder="Please Enter Ring Number"/>           
      </div>

    </div>
    <!--close div add Ring Nr-->

    <!--start div add Code-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">RFID code:</label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: uppercase;" class="form-control" type="number" name="rfid"placeholder="Please Enter RFID/Code number"/>           
      </div>

    </div>
    <!--close div add Code-->

   <!-- start div Select color-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Color:<label style="color: red">*</label></label>      
          <div class="col-sm-7">
          	<select class="form-control" name="color" required="required">
          		<option value="">--Select--</options>
				 	<?php 
				 		$sql="select * from color order by color";
				 		$res=$db->query($sql);
				 		while ($row=$res->fetch_assoc()) {
				 			echo "<option value='{$row["color"]}'>
				 			{$row["color"]}</option>";
				 		}
				 	?>	          		
          	</select>
          </div>
    </div>
    <!-- close div Select color--> 

    <!--start div add First strain-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Strain:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: capitalize;" class="form-control" type="text" name="strain" required="required" placeholder="Please Enter strain (put unknown if unknown)"/>
      </div>
    </div>
    <!--close div add strain-->

    <!-- start div Select gender-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Gender:<label style="color: red">*</label></label>      
          <div class="col-sm-7">
            <select class="form-control" name="gender" required="required">
              <option value="">--Select--</options>
              <option value="C">Cock</options>
              <option value="H">Hen</options>
              <option value="U">Unknown</options>
            </select>
          </div>
    </div>
    <!-- close div Select gender-->

    <!--start div add Name-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-7">
          <input style="width: 100%; text-transform: uppercase;" class="form-control" type="text" name="name" placeholder="Please Enter Name (Optional)"/>
      </div>
    </div>
    <!--close div add Name-->
    
    <!-- start div Select sire-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Sire (Father) Ring Nr:</label>      
          <div class="col-sm-7">
            <select class="form-control" name="sire">
              <option value="">--Select--</options>
          <?php 
            $sql="select *, ucase(ring_nr) as upperring from p_details where uid = $login_id and gender = 'C' and status = 'Active' order by ring_nr";
            $res=$db->query($sql);
            while ($row=$res->fetch_assoc()) {
              echo "<option value='{$row["upperring"]}'>
              {$row["upperring"]}</option>";
            }
          ?>                
            </select>
          </div>
    </div>
    <!-- close div Select sire--> 

    <!-- start div Select dam-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Dam (Mother) Ring Nr:</label>      
          <div class="col-sm-7">
            <select class="form-control" name="dam">
              <option value="">--Select--</options>
          <?php 
            $sql="select *, ucase(ring_nr) as upperring from p_details where uid = $login_id and gender = 'H' and status = 'Active' order by ring_nr";
            $res=$db->query($sql);
            while ($row=$res->fetch_assoc()) {
              echo "<option value='{$row["upperring"]}'>
              {$row["upperring"]}</option>";
            }
          ?>                
            </select>
          </div>
    </div>
    <!-- close div Select dam--> 

    
     <!--start div date hatched-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Hatched:</label>
        <div class="col-sm-7">
          <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
          <div class="bootstrap-iso">          
                <input class="form-control" id="date" name="datehatched" placeholder="YYYY-MM-DD" type="text"/>                
          </div>
         </div>              
    </div>
    <!--close div date hatched-->

   


<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="bootstrap-datepicker3.css"/>

<script>
  $(document).ready(function(){
    var date_input=$('input[name="datehatched"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
  })
</script>

<!-- start div how obtain-->       
    <div class="form-group">       
        <label class="col-sm-3 control-label">Obtained Through:<label style="color: red">*</label></label>      
          <div class="col-sm-7">
            <select class="form-control" name="howobtain" required="required">
              <option value="">--Select--</options>
          <?php 
            $sql="select * from obtain_through order by obtain_through";
            $res=$db->query($sql);
            while ($row=$res->fetch_assoc()) {
              echo "<option value='{$row["obtain_through"]}'>
              {$row["obtain_through"]}</option>";
            }
          ?>                
            </select>
          </div>
    </div>
    <!-- close div how obtain--> 

     <!--start div add remarks-->  
    <div class="form-group">
      <label class="col-sm-3 control-label">Remarks:</label>
        <div class="col-sm-7">
          <textarea class="form-control" name="remarks" ></textarea>
      </div>
    </div>
    <!--close div add remarks-->

    <div class="form-group">
        <div class="col-sm-7 control-label">        	
        	<br>
        	<button class="btn btn-primary" type="submit" name="submit">Save</button>
      </div>
    </div>          
  </form>
</div>
<!--end div form-->

</body>
</html>