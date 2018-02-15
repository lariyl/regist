<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - View Reports')); ?>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sidebar',array('isViewReports' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<h1>View Reports Stuff here</h1>
				</div>
			</div>
		</div>
	</body>
</html>