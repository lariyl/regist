<?php
$id=$this->session->userdata('id');
 
if(!$id){
 
  redirect('user/login_view');
}
 
 ?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile Dashboard-CodeIgniter Login Registration</title>
          <!-- Bootstrap core CSS-->
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
  </head>


  <body>
 <p class="navbar-text navbar-left">Signed in as <a href="#" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
<div class="container">
  <div class="row">
    <div class="col-md-4">
 
      <table class="table table-bordered table-striped">
 
 
        <tr>
          <th colspan="2"><h4 class="text-center">User Info</h3></th>
 
        </tr>
          <tr>
            <td>User Name</td>
            <td><?php echo $this->session->userdata('username'); ?></td>
          </tr>
          <tr>
            <td>User Email</td>
            <td><?php echo $this->session->userdata('email');  ?></td>
          </tr>
      </table>
 
 
    </div>
  </div>
<a href="<?php echo base_url('user/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
</div>
  </body>
</html>