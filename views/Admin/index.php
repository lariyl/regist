<html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>THESIS - Admin Index Page</title>
	   <?php echo getCSS(); ?>
	   <?php echo getJS(); ?>
  </head>
<body>
 

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('admin/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>     
        <a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Logout</button>
      </div>
    </nav>

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
 
 
 
 
  </body>
</html>
