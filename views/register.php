<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>THESIS REGISTRATION</title>
 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen" title="no title">
 <script type="text/javascript"></script>
 
  </head>
  <body>
 
<span style="background-color:red;">
  <div class="w3-container" style="margin-top:150px"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="w3-row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Registration</h3>
                  </div>
                  <div class="panel-body">
 
                  <?php
                  $error_msg=$this->session->flashdata('error_msg');
                  if($error_msg){
                    echo $error_msg;
                  }
                   ?>
                      <form role="form" method="post" action="<?php echo base_url('user/register_user'); ?>">
											 <p><input class="form-control" placeholder="Username" name="username" type="text" required></p>
                       <p><input class="form-control" placeholder="E-mail" name="email" type="email" required></p>
                       <p><input class="form-control" placeholder="Password" id="password" name="password" type="password" required></p>
                       <p><input class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" type="password" required></p>
                       <span id="confirmMessage" class="confirmMessage"></span>
 											 <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >
                      </form>
                      <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>">Login here</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- verification on password -->
 <script>
 var password = document.getElementById("password")
  , confirmpassword = document.getElementById("confirmpassword");

function validatePassword(){
  if(password.value != confirmpassword.value) {
    confirmpassword.setCustomValidity("Passwords Don't Match");
  } else {
    confirmpassword.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirmpassword.onkeyup = validatePassword;
 </script>
</span>
 
 
 
 
  </body>
</html>
