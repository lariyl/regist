<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>THESIS</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen" title="no title">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>


<p class="w3-left" style="padding-left:450px" >Signed in as <a href="<?php echo base_url('auth/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
<p class="w3-left" style="padding-left:180px"><a href="<?php echo base_url('auth/logout');?>" >  <button type="button" class="btn-primary">Logout</button></a></p>

    <div class="w3-container" style="margin-top:150px">
    <div class="w3-row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
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

<!--  <?php echo validation_errors(); ?> -->
 				<?php echo form_open('auth/updatePwd'); ?>
 				<div class="panel-body">
            <label>Current Password</label>
                    <?php echo form_password(['name'=>'password', 'placeholder'=>'Password']); ?>
                    <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
				   <label>New Password</label>
                    <?php echo form_password(['name'=>'newpass','placeholder'=>'New Password']); ?>
                    <?php echo form_error('newpass', '<div class="text-danger">', '</div>'); ?>
				   <label>Confirm Password</label>
                    <?php echo form_password(['name'=>'confpassword', 'placeholder'=>'Password Confirmation']); ?>
                    <?php echo form_error('confpassword', '<div class="text-danger">', '</div>'); ?>

                   <?php echo form_submit(['name'=>'submit', 'value'=>'Update Password']); ?> 
                   <?php echo form_close(); ?>	
        </div>
   </body>
</html>