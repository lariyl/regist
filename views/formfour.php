<?php
$id=$this->session->userdata('id');
 
if(!$id){
 
  redirect('user/login_view');
}
 
 ?>
 
<html>
<title>Form 4</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script scr="<?php echo base_url(); ?>assets/css/bootstrap.min.js"></script> 
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>

<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Dashboard</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">Courses <i class="fa fa-caret-down"></i></a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding w3-blue" onclick="document.getElementById('createcourse').style.display='block'">Create a Course</a> 
      <a href="helloworld" class="w3-bar-item w3-button">A Course</a>
    </div>
    <a href="<?php echo base_url('user/changepass'); ?>" class="w3-bar-item w3-button">Change Password</a> 
  </div>  
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">Dashboard</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Signed in as <a href="<?php echo base_url('user/user_profile');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
    <p class="w3-right"><a href="<?php echo base_url('user/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a></p>

  </header>
  
  <!--Dashboard Header -->
  <header class="w3-container w3-xlarge" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>



 <!--  <div id="ajax-content">
    <button type="button" onclick="loadDoc()">Press Button</button>
  </div>

  <script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("ajax-content").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url('user/helloworld');?>", true);
  xhttp.send();
}
</script> -->
 
     <!-- Add an Exam -->
<!--     <p class="w3-left"> -->
    <!-- <input type="button" class="w3-button w3-green" value="Add Exam"> -->
<!--     <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding w3-green" onclick="document.getElementById('addexam').style.display='block'">Add Exam</a>  -->
    <p class="w3-center"><b>OBTL Form 4</b></p>
    <p class="w3-center"><b>Course Assessment Report</b></p>
    <!-- Print Record -->
    <p class="w3-right">
    <input type="button" class="w3-button w3-brown" value="Print Record">


<!--Class Record -->
  <div class="w3-container">
    <h5>A Course</h5>
    <div class="w3-table">
    <table class="w3-table-all">
      <tr class="w3-cyan">
       <th>Course OUtcome</th>
       <th>Assessment Task/Output</th>
       <th>Student's Level of Achievement Outcome
        <div class="row">
         <div class="col-sm-3">1.0</div>
         <div class="col-sm-3">2.0</div>
         <div class="col-sm-3">3.0</div>
         <div class="col-sm-3">4.0</div>
        </div>
       </th> 
       <th>Target</th>
       <th>Gap</th>
      </tr>
      <tr>
       <td>CO1</td>
       <td>1.0</td>
       <td>
       <div class="row">
         <div class="col-sm-3">1</div>
         <div class="col-sm-3">10</div>
         <div class="col-sm-3">15</div>
         <div class="col-sm-3">1</div>
        </div>
       </td>
       <td>80% of cohort with rating of 2.0 or better</td>
       <td>1.0</td>
      </tr>
      <tr>
       <td>C02</td>
       <td>1.0</td>
       <td>
       <div class="row">
         <div class="col-sm-3">1</div>
         <div class="col-sm-3">10</div>
         <div class="col-sm-3">15</div>
         <div class="col-sm-3">2</div>
        </div>
       </td>
       <td>80% of cohort with rating of 2.0 or better</td>
       <td>1.0</td>
      </tr>
      <tr>
       <td>C03</td>
       <td>1.0</td>
       <td>
       <div class="row">
         <div class="col-sm-3">1</div>
         <div class="col-sm-3">10</div>
         <div class="col-sm-3">0</div>
         <div class="col-sm-3">2</div>
        </div>
       </td>
       <td>80% of cohort with rating of 2.0 or better</td>
       <td>1.0</td>
      </tr>
    </table>
    <div class="row">
      <div class="col-xs-9 col-md-7">1.0 – Exceeds Expectations (evaluation of output may range from 1.0 to 1.4)  </div>
      <div class="col-xs-3 col-md-5">3.0 – Partially Meet Expectations (evaluation of output may range from 2.5 to 3.0)</div>
    </div>
    <div class="row">
      <div class="col-xs-9 col-md-7">2.0 – Meets Expectations (evaluation of output may range from 1.5 to 2.4)</div>
      <div class="col-xs-3 col-md-5">4.0 – Does Not Meet Expectations (evaluation of output with a rating of 3.0 or lower)</div>
    </div>  
 </div>
</div>



<div class="row">
 <div class="col-xs-9 col-md-7">Total No. of Students Enrolled: </div>
</div>  
<div class="row">
  <div class="col-xs-9 col-md-7">No. of Students Passed: </div>
</div>  
 
<!--   <a href="#" button type="submit" class="w3-button w3-block w3-blue">Submit </button> </a> -->
  <!-- End page content -->

<!-- Create a Course Modal -->
<div id="createcourse" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <!-- x button -->
      <i onclick="document.getElementById('createcourse').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">Course</h2>
      <form method="post" id="user_form" data-action="Create">
       <p><input type="text" id="subject"  class="w3-input w3-border" placeholder="Course Subject"  required></p>
       <p><input type="text" id="description" class="w3-input w3-border" placeholder="Description"  required ></p>
<!--        <p><input type="file" id="course_file" class="w3-input w3-border" ></p> -->
       <input type="submit" class="btn btn-primary" name="action" value="Create"/>
   <!--     <button type="button" class="w3-button w3-padding-large w3-blue w3-margin-bottom"  onclick="document.getElementById('createcourse').style.display='block'">Create</button>
    -->   </form>
    </div>
  </div>
</div>



<!-- Add Exam Modal -->
<div id="addexam" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('addexam').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">Add Exam</h2>
      <form method="post" target="_blank">
       <p><input class="w3-input w3-border" placeholder="Course Outcome" type="text" required></p>
       <p><input class="w3-input w3-border" placeholder="Description" type="text" required ></p>
       <p><input class="w3-input w3-border" placeholder="Weight" type="float" required ></p>
       <button type="button" class="w3-button w3-padding-large w3-green w3-margin-bottom" onclick="document.getElementById('addexam').style.display='block'">Add Exam</button>
      </form>
    </div>
  </div>
</div>


<script>
// Accordion 
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}


// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}


// ajax for creating a course
$(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var subject = $('#subject').val();
  var description = $( '#description').val(); 

  var ajaxdata = {action: $(this).data('action'), psubject: subject, pdescription: description};

  if(subject != '' && description !='')
  {
    $.ajax({
      url: "<?php echo base_url(). 'user/user_action'?>",
      type: 'POST',
      data: ajaxdata,
      // contentType:false,
      // processData:false,
      success:function(response)
      {
        console.log(response);
        $('#user_form')[0].reset();
        $('#createcourse').hide();
      }
    });
  }
  else
  {
    alert("Both fields are required");
  }
});
</script>


</body>
</html>