<!DOCTYPE html>
<html>
<p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('auth/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - User')); ?>
	</head>



	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar'); ?>
				<div class="col-md-10 col-md-offset-2 main">
					<h1>Nothing to show here.</h1>
				</div>
			</div>
		</div>
	</body>

</html>