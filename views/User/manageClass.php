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
							echo "<div class='panel-heading'><div class='panel-title Title'>$c->code</div></div>";
							echo "<div class='panel-body'>
											<p><b>Title: </b> <span>$c->title</span></p>";
							echo $c->is_approved ? "<p><button class='btn btn-primary' id='change' data-toggle='modal' data-target='#add-class-modal'>Schedule a Class</button></p>": "<p class='text-danger'>This course is not approved yet.</p>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					?>

				</div>
			</div>
		</div>


		<div class="modal fade" id="add-class-modal">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<h4 class="modal-title code" name="coursecode">Add Class</h4>
						<h4 class="modal-title title" name="title">Title</h4>							
					</div>
					<div class="modal-body">
        				<div class="form-group">
							<p><input class="form-control" placeholder="Groupname" id="add-class-groupname" name="groupname" type="text" required ></p>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<p><input class="form-control" placeholder="Schedule" id="add-schedule-groupname" name="schedule" type="text" required ></p>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<p><input class="form-control" id="add-file-groupname" name="filename" type="file" required ></p>
							<div class="help-block with-errors"></div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary confirm-add">Create Class</button>
						</div>
					</div>
				</div>
			</div>
		</div>


<script>
	var $doc = $(document);	

$(document).ready(function(){
    $("#change").click(function(){
        $(".code").text("val");
        $(".title").text("<?php echo $c->title?>");

    });
});
</script>

	</body>
</html>