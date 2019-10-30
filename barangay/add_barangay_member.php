<?php 
include('session.php');
    if ($login_access_id != 2) {
  header("location:../logout.php");  }
?>
<!DOCTYPE html>
<html>
 <head>
  <title>OSYTS</title>
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

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="barangay">Home</a></li>
        <li><a href="add-barangay-member">Refresh</a></li>
        <li><a href="barangay-members">Out-of-School-Children-and-Youth List</a></li>
    </div>
  </div>
</nav>


    <h4 align="center">Add Out-of-School-Children-and-Youth</h4>
    <div align="center">Fields marked with <span style="color: red"> * </span> are mandatory.</div>

  <br />
<!--start div Form-->
<div class="container">   
   <form class="form-horizontal" action="insert-barangay-member" method="post">
    
    <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date Enter:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="djoined" type="date" required="required"/>
        </div>        
    </div>
    <!--close div club id-->  

    <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Barangay ID:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input style="text-transform: uppercase;" class="form-control" name="club_id" type="text" required="required" placeholder="Please Enter Barangay ID Number"/>
        </div>        
    </div>
    <!--close div club id-->  
    
    <!--start div fullname-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="fname" type="text" required="required" placeholder="Please Enter Full Name"/>         
        </div>        
    </div>
    <!--close div fullname-->    

 <!-- start div Select sex-->       
                          <div class="form-group">                             
                            <label class="col-sm-3 control-label">Sex:<label style="color: red">*</label></label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="sex" required="required">
                                  <option value="">--Select--</options>
                                  <option value="M">Male</options>
                                  <option value="F">Female</options>
                                </select>
                              </div>                                        
                        </div>
                      <!-- close div Select sex--> 

                      <!-- start div Select sex-->       
                          <div class="form-group">                             
                            <label class="col-sm-3 control-label">Status:<label style="color: red">*</label></label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="stat" required="required">
                                  <option value="">--Select--</options>
                                  <option value="Single">Single</options>
                                  <option value="Married">Married</options>
                                  <option value="Widow">Widow</options>
                                  <option value="Widower">Widower</options>
                                </select>                              
                              </div>                                         
                        </div>
                      <!-- close div Select sex--> 

                      <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Date of Birth:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="dob" type="date" required="required"/>
        </div>        
    </div>
    <!--close div club id-->  

<!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Skill(s):<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="skill" type="text" required="required" placeholder="Please Enter Skill(s)"></textarea>
        </div>        
    </div>
    <!--close div club id-->  

        <!--start div club id-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Address:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="address" type="text" required="required" placeholder="Please Enter Address"></textarea>
        </div>        
    </div>
    <!--close div club id-->  

<!--start div coord long-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Lat:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="coord_lat" type="text" required="required" placeholder="Please Enter Decimal Degrees Coordinate Latitude (12.200020)"/>
        </div>        
    </div>
    <!--close div coord long--> 
       
    <!--start div coord long-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Coordinate Long:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="coord_long" type="text" required="required" placeholder="Please Enter Decimal Degrees Coordinate Longtitude (120.200020)"/>
        </div>        
    </div>
    <!--close div coord long-->      

     <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Contact #:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="contact" type="text" required="required" placeholder="Please Enter Contact Number">
        </div>        
    </div>
    <!--close div contact-->

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-7">
          <input class="form-control" name="email" type="email" placeholder="Please Enter Email">
        </div>        
    </div>
    <!--close div contact-->
     
     <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Nr of Siblings:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="sibling" type="number" required="required" placeholder="Please Enter Nr of Siblings">
        </div>        
    </div>
    <!--close div contact-->

    <!-- start div Select sex-->       
                          <div class="form-group">                             
                            <label class="col-sm-3 control-label">Educational Attainment:<label style="color: red">*</label></label>      
                              <div class="col-sm-7">
                                <select class="form-control" name="educ" required="required">
                                  <option value="">--Select--</options>
                                  <option value="CU">College undergraduate</options>
                                  <option value="SHG">Senior Highschool graduate</options>
                                  <option value="SHU">Senior Highschool undergraduate</options>
                                  <option value="HG">Highschool graduate</options>
                                  <option value="HU">Highschool undergraduate</options>
                                  <option value="EG">Elementary graduate</options>
                                  <option value="EU">Elementary undergraduate</options>
                                </select>                              
                              </div>                                         
                        </div>
                      <!-- close div Select sex--> 

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Father's Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="father" type="text" required="required" placeholder="Please Enter Father's Name">
        </div>        
    </div>
    <!--close div contact-->

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Father's Occupation:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="foccu" type="text" required="required" placeholder="Please Enter Father's Occupation">
        </div>        
    </div>
    <!--close div contact-->

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Mother's Name:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="mother" type="text" required="required" placeholder="Please Enter Mother's Name">
        </div>        
    </div>

    <!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Mother's Occupation:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <input class="form-control" name="moccu" type="text" required="required" placeholder="Please Enter Mother's Occupation">
        </div>        
    </div>
    <!--close div contact-->


<!--start div contact-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Reasons for being out of school:<label style="color: red">*</label></label>
        <div class="col-sm-7">
          <textarea class="form-control" name="remark" required="required" placeholder="Please Enter Reasons"></textarea>
        </div>        
    </div>
    <!--close div contact-->
    

    <!--start div no records-->
    <div class="form-group" style="text-align: center;">
          <br>
        <button class="btn btn-primary" type="submit" name="submit">Save</button>             
      <br />       
        </div>  

    </div>
    <!--close div no records-->

    
      
    </div>
  </form>
</div>
<!--end div form-->
   
 </body>
</html>
<!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/scripts.js"></script>