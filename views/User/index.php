<html>
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
                    echo "<option class='add-group-course' value='$lc->id'>$lc->subject</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="dropdown">
               <h5>Current Subject</h5>
               <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select Subject<span class="caret"></span></button>
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
    </div>

  <script>
    $(document).ready(function(){
      $("#course-list").multiselect({
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%'
      });
    });

    var courseApp = {
        pageEvents: function() {
          $doc.on('click', '.add-group-course', function () {
            alert('hi');;
          });
        },
       } 

  </script>

</body>
</html>