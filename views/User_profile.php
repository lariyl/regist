<?php
$id=$this->session->userdata('id');
$username=$this->session->userdata('username'); 
// if(!isset($_SESSION['username']) || $_SESSION['password'] !='admin'){
//     redirect('user/user_profile');
// } 
if($username == 'admin')
	{ 
  redirect('user/admin_view');
  }

 ?>
 
<html>
<title>Record Module</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="http://davidstutz.de/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>


<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://davidstutz.de/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>

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

	<div>
		<label>Courses</label>
		<select id="course-list" >
			<?php
			foreach($list_course as $idx => $lc)
			{
				echo "<option value='$lc->id'>$lc->subject</option>";
			}
			?>
		</select>
	</div>

  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">Courses <i class="fa fa-caret-down"></i></a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding w3-blue" onclick="document.getElementById('createcourse').style.display='block'">Create a Course</a>
      <?php
        foreach($list_course as $value){
          echo  "<a href='#' data-id='$value->id'  class='w3-bar-item w3-button course'>$value->subject</a>";
          // echo "<a href='#' onclick='alert('Procede?')' >$value->subject</a>";
        }
      ?>
    </div>
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">Current Courses <i class="fa fa-caret-down"></i></a>
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">Past Courses <i class="fa fa-caret-down"></i></a>
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

    <p class="w3-center"><b>Students Record</b></p>
     <!-- Add an Exam -->
    <p class="w3-left">
    <!-- <input type="button" class="w3-button w3-green" value="Add Exam"> -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding w3-green" onclick="document.getElementById('addexam').style.display='block'">Add Exam</a>
    <!-- Print Record -->
    <p class="w3-right">
    <input type="button" class="w3-button w3-brown" value="Print Record">


<!--Class Record -->
  <div class="w3-container">
    <h5 id=coursename> <?php echo "$value->subject";?></h5>
  </div>

<!-- Import Class List -->
      <div class="container box">
          <form method="post" id="import_csv" enctype="multipart/form-data">
            <div class="form-group">
              <label>Select CSV File</label>
              <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
            </div>
              <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
          </form>
        <div id="imported_csv_data"></div>
      </div>


<!--     <div class="w3-responsive">
     <table class="w3-table-all">
      <tr class="w3-cyan">
       <th>Student Name</th>
       <th>Pre-Mid</th>
       <th>Midterm</th>
       <th>Pre-Fi</th>
       <th>Finals</th>
       <th>Final Grade</th>
      </tr>
     </table>
      <tr>
       <td>John Doe</td>
       <td>1.0</td>
       <td>1.0</td>
       <td>1.0</td>
       <td>1.0</td>
       <td>1.0</td>
      </tr>
    </table>
  </div>
  -->

  <!-- Reports -->
  <footer class="w3-panel w3-padding-small w3-light-grey w3-small w3-center" id="reports" >
    <div class="w3-container">
      <h4>Reports</h4>
        <div class="w3-responsive">
         <table class="w3-table">
          <tr>
            <th>Course Outcome</th>
            <th>Attained?</th>
            <th>Comment</th>
          </tr>
            <tr>
              <td>Course Outcome 1</td>
              <td>Yes</td>
              <td>CO attained</td>
            </tr>
           <tr>
              <td>Course Outcome 2</td>
              <td>Yes</td>
              <td>CO attained</td>
            </tr>
            <tr>
              <td>Course Outcome 3</td>
              <td>Yes</td>
              <td>CO attained</td>
            </tr>
        </table>
      </div>
    </div>
  </footer>

  <!-- Action Plan -->
  <footer class="w3-panel w3-padding-small w3-light-grey w3-small w3-center" id="actionplan" >
    <div class="w3-container">
      <h4>Action Plan</h4>
        <div class="w3-responsive">
         <table class="w3-table">
          <tr>
            <th>Course Outcome</th>
            <th>Suggestive Action Plan</th>
          </tr>
            <tr>
              <td>Course Outcome 1</td>
              <td>Retain</td>
            </tr>
           <tr>
              <td>Course Outcome 2</td>
              <td>Change</td>
            </tr>
            <tr>
              <td>Course Outcome 3</td>
              <td>Change</td>
            </tr>
        </table>
      </div>
    </div>
  </footer>
  <a href="<?php echo base_url('user/formfour');?>" > <button type="submit" class="w3-button w3-block w3-blue">Submit</button></a>
  <!-- End page content -->
</div>

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
        <input type="submit" class="btn btn-primary" name="action" value="Add Exam"/>
       <!-- <button type="button" class="w3-button w3-padding-large w3-green w3-margin-bottom" onclick="document.getElementById('addexam').style.display='block'">Add Exam</button> -->
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

//change course in the UI
$(document).on('click', '.course', function(){
  event.preventDefault();
  $elementClicked = $(this);

  $.ajax({
    url: "<?php echo base_url(). 'user/user_profile'?>",
    type: 'POST',
    success: function(response){
      // $('#coursename').remove();
      // $("#coursename").text($("#8").text());
      $("#coursename").text($elementClicked.text());
    }

  })
})

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
        $resp = JSON.parse(response);
        console.log(response);
        $('#user_form')[0].reset();
        $('#createcourse').hide();
        $('#demoAcc').append( "<a href='#' data-id='"+$resp['id']+"' class='w3-bar-item w3-button'>"+$resp['subject']+"</a>");

      }
    });
  }
  else
  {
    alert("Both fields are required");
  }
});

// Ajax Import
$(document).ready(function(){

	$("#course-list").multiselect({
		enableCaseInsensitiveFiltering: true
	});

  load_data();

  function load_data()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>user/load_data",
      method:"POST",
      success:function(data)
      {
        $('#imported_csv_data').html(data);
      }
    })
  }

  $('#import_csv').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"<?php echo base_url(); ?>user/import",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn').html('Importing...');
      },
      success:function(data)
      {
        $('#import_csv')[0].reset();
        $('#import_csv_btn').attr('disabled', false);
        $('#import_csv_btn').html('Import Done');
        load_data();
      }
    })
  });

});



</script>


</body>
</html>