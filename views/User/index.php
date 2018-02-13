<!DOCTYPE html>
<html>
<<<<<<< HEAD
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Module</title>
    <?php echo getCSS(); ?>
    <?php echo getJS(); ?>
  </head>

<body>




<!-- Sidebar/menu -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('auth/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
          <a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Logout</button></a>
          <a href="<?php echo base_url('auth/changePassword');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Change Password</button></a>
        </div>
      </nav>

    <div class="container">
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>
      </div>
        <div class="dropdown" >
          <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
              <div>
                <h5>Approved Course</h5>
                <select id="course-list" >
                  <?php
                  foreach($list_course as $idx => $lc)
                  {
                    echo "<option class='add-group-course' data-toggle='modal' data-target='#add-group-modal' value='$lc->id'>$lc->subject</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="dropdown">
               <h5>Current Subject</h5>
               <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select Subject<span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                </ul>
              </div>

              <div class="dropdown">
               <h5>Past Subject</h5>
               <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Past Subject<span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                </ul>
              </div>
           </ul>
         </div>
        </div>


          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>#ID Number</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
              </tbody>
            </table>
          </div>


          <h2 class="sub-header">Reports</h2>
          <div class="table-responsive col-md-6col-xs-6 col-md-4 ">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Course Outcome</th>
                  <th>Attained?</th>
                  <th>Comment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                </tr>
              </tbody>
            </table>
          </div>


    </div>


    <!-- MODALS AREA -->
    <div class="modal fade" id="add-group-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            <h4 class="modal-title">Add User</h4>
          </div>
          <form id="add-group-form"  data-toggle="validator" role="form">
            <div class="modal-body">
              <div class="form-group">
                <p><input class="form-control" placeholder="Group Name" id="add-group-username" name="groupname" type="text" required ></p>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <p><input class="form-control" id="add-group-file" name="importfile" type="file" required></p>
                <div class="help-block with-errors"></div>
              </div>
            </div>  
            <div class="modal-footer">
              <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" >Add Subject</button>
            </div>
          </form>
        </div>
      </div>
    </div>



  <script>
    var $doc = $(document);
    
    $(document).ready(function(){
      $("#course-list").multiselect({
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%'
      });
    });

    $doc.on('change', '#course-list', function () {
      alert('hi');
    });
        

  
          // $('#dropdownMenu1').on('click', function () {
          //   alert('hi');
          // });
  </script>

</body>
=======
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Record Module</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>
		<?php $this->load->view('Partials/styles'); ?>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><a href="#">Manage Class</span></a></li>
						<li><a href="#">Input Grades</span></a></li>
					</ul>
				</div>

				<div class="col-md-8">
					<table class="table table-danger">
						<thead>
							<tr>
								<th>test</th>
							</tr>

						</thead>
						<tbody>
							<tr>
								<td>ioadjasljdoai</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</body>
>>>>>>> prince
</html>