<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>THESIS</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen" title="no title">
  </head>
  <body>
  
    <div class="w3-container" style="margin-top:150px">
    <div class="w3-row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <?php
              $success_msg= $this->session->flashdata('success_msg');
              $error_msg= $this->session->flashdata('error_msg');
 
                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                  ?>
 
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo base_url('user/login_user'); ?>">
                      <label>Username</label>
                      <p><input class="form-control" placeholder="Username" name="username" type="text" required></p>
                      <label>Password</label>
                      <p><input class="form-control" placeholder="Password" name="password" type="password" required></p>
                      <p><input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login"></p>
                    </form>
                <!-- <center><b>Not registered ?</b> <br></b><a href="<?php echo base_url('user/registration'); ?>">Register here</a></center>-->
                <!--for centered text-->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>

