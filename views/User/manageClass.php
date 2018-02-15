<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Manage Class')); ?>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sidebar',array('isManageClass' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<h1>Manage Class Stuff here</h1>
				</div>
			</div>
		</div>
	</body>
</html>