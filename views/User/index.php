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
<<<<<<< HEAD
				<div class="col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="active"><a href="#">Manage Class</span></a></li>
						<li><a href="#">Input Grades</span></a></li>
						<li><a href="#">View Reports</span></a></li>
					</ul>
				</div>
				<div class="col-md-10 col-md-offset-2 main">
					<table class="table table-danger">
						<thead>
							<tr>
								<th>test</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>ioadjasljdoai</td>
							</tr>
						</tbody>
					</table>
=======
				<?php $this->load->view('Partials/sidebar'); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<h1>Nothing to show here.</h1>
>>>>>>> prince
				</div>
			</div>
		</div>
	</body>

</html>