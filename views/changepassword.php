<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change PAssword</title>
    <?php echo getCSS(); ?>
    <?php echo getJS(); ?>
  </head>

  <body>


      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('auth/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
          <a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Logout</button></a>
          <a href="<?php echo base_url('auth/changePassword');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Change Password</button></a>
        </div>
      </nav>


    <div class="container">
    <div class="row">
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
        <form role="form" method="post" action="<?php echo base_url('auth/updatePassword'); ?>"> 				
          <div class="panel-body">
            <div class="form-group">
              <?php echo form_password(['class' => 'form-control', 'name'=>'password', 'placeholder'=>'Password']); ?>
              <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
				    </div>
           <div class="form-group">
            <?php echo form_password(['class' => 'form-control', 'name'=>'new_password','placeholder'=>'New Password']); ?>
            <?php echo form_error('new_password', '<div class="text-danger">', '</div>'); ?>
				   </div>
           <div class="form-group">
            <?php echo form_password(['class' => 'form-control', 'name'=>'confirm_password', 'placeholder'=>'Password Confirmation']); ?>
            <?php echo form_error('confirm_password', '<div class="text-danger">', '</div>'); ?>
           </div>
            <?php echo form_submit(['class' => 'btn btn-lg btn-success btn-block', 'name'=>'submit', 'value'=>'Update Password']); ?> 
            <?php echo form_close(); ?>	
        </div>
   </body>
</html>