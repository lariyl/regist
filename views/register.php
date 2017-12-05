<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>THESIS REGISTRATION</title>
 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen" title="no title">
 <script type="text/javascript" src="/code_examples/passtest.js"></script>
 
  </head>
  <body>
 
<span style="background-color:red;">
  <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
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
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Username" name="username" type="text" required >
                              </div>
 
                              <div class="form-group">
                                  <input class="form-control" placeholder="E-mail" name="email" type="text" required >
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Password" id="password" name="password" type="password" required >
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" onkeyup="checkPass(); return false;" type="password" required>
                                  <span id="confirmMessage" class="confirmMessage"></span>
                              </div>
 
                       <!--   <button onclick="myFunction()">Register</button> -->
                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >
 
                          </fieldset>
                      </form>
                      <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>">Login here</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- verification on password -->
 <script>
 function checkPass()
{
    //Store the password field objects into variables
    var password = document.getElementById('password');
    var confirmpassword = document.getElementById('confirmpassword');
    //Store the Confimation Message Object
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(password.value == confirmpassword.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        confirmpassword.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirmpassword.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
        // alert("Password doens't match");
        // redirect('user');
    }
}  
 </script>
</span>
 
 
 
 
  </body>
</html>