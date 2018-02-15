<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Change Password')); ?>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 main">
					<div class="login-panel panel panel-success">
						<div class="panel-heading"><h3 class="panel-title">Change Password</h3></div>
						<div class="panel-body">
							<?php
								$success_msg= $this->session->flashdata('success_msg');
								$error_msg= $this->session->flashdata('error_msg');

								if($success_msg)
								{
									echo "<div class='alert alert-success'>$success_msg</div>";
								}
								elseif($error_msg)
								{
									echo "<div class='alert alert-danger'>$error_msg</div>";
								}
								echo validation_errors();
							?>

							<form role="form" method="post" action="<?php echo base_url('User/updatePassword'); ?>">
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
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>