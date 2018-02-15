<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Manage Class')); ?>

		<style>
			.course-panel{
				width: 100%;
				height: 150px;
				display: inline-block;
				margin: 5px;
			}
		</style>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isManageClass' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">

					<?php
						foreach($courses->result() as $i => $c)
						{
							echo "<div class='col-md-4'>";
							echo "<div id='$c->code' class='panel course-panel ".($c->is_approved ? 'panel-info' : 'panel-default')."'>";
							echo "<div class='panel-heading'><div class='panel-title'>$c->code</div></div>";
							echo "<div class='panel-body'>
											<p><b>Title: </b> <span>$c->title</span></p>";
							echo $c->is_approved ? "<p><button class='btn btn-primary'>Schedule a Class</button></p>": "<p class='text-danger'>This course is not approved yet.</p>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					?>

				</div>
			</div>
		</div>
	</body>
</html>