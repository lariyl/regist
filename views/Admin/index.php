<html>
<html>
  <head>
    <title>THESIS Admin Index Page</title>
	<?php echo getCSS(); ?>
	<?php echo getJS(); ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script scr="<?php echo base_url(); ?>assets/css/bootstrap.min.js"></script> 
  </head>
  <body>
 
<span style="background-color:red;">
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Signed in as <a href="<?php echo base_url('admin/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
    <p class="w3-right"><a href="<?php echo base_url('auth/logout');?>" >  <button type="button" class="btn-primary">Logout</button></a></p>
  </header>
  
  <div class="w3-container"><!-- container class is used to centered  the body of the browser with some decent width-->
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
                      <form role="form" method="post" action="<?php echo base_url('admin/registerUser'); ?>">
                       <p><input class="form-control" placeholder="Username" name="username" type="text" required></p>
                       <p><input class="form-control" placeholder="E-mail" name="email" type="email" required></p>
                       <p><input class="form-control" placeholder="Password" id="password" name="password" type="password" required></p>
                       <p><input class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" type="password" required></p>
                       <span id="confirmMessage" class="confirmMessage"></span>
                       <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >
                      </form>
<!--                  <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>">Login here</a></center>-->
                  </div>
              </div>
          </div>
      </div>
  </div>

      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Delete</th>
          </tr>
        <?php
        if($fetchData->num_rows() >0)
        {
          foreach($fetchData->result() as $row)
          {
        ?>
          <tr>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->email; ?></td>
        <td><a href="#" class="delete_data" id="<?php echo $row->id; ?>"> Delete</a></td>

          </tr>
        <?php
          }
        }
        else
        {
        ?>
          <tr>
            <td colspan="3"> No Data Found</td>
          </tr>
        <?php 
        }
        ?>
        </table>
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

$(document).ready(function(){
      $('.delete_data').click(function(){
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?"))
        {
          window.location= "<?php echo base_url(); ?>admin/deleteData/"+id;
        }
        else
        {
          return false;
        }
      });
    });
 </script>
</span>
 
 
 
 
  </body>
</html>
