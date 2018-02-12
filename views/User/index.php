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
          <p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('admin/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
          <a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Logout</button></a>
          <a href="<?php echo base_url('auth/changePassword');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Change Password</button></a>
        </div>
      </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <div>
              <h3>Approved</h3>
              <select id="course-list" >
                <?php
                foreach($list_course as $idx => $lc)
                {
                  echo "<option value='$lc->id'>$lc->subject</option>";
                }
                ?>
              </select>
            </div>
          </ul>
        </div>
      </div>
    </div>

  <script>
    $(document).ready(function(){
      $("#course-list").multiselect({
        enableCaseInsensitiveFiltering: true
      });
    });

  </script>

</body>
</html>