<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Manage Class')); ?>

		<style>
			.course-panel{
				width: 100%;
				height: 160px;
				display: inline-block;
				margin: 5px;
			}
			.course-panel-completed{
				width: 100%;
				height: 180px;
				display: inline-block;
				margin: 5px;
			}
			.btn-md{
				margin-left: 5px; 
			}
			.start-class{
				font-size: .9em;
			}
			.my-label{
				font-size: .9em;
			}
		</style>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isManageClass' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<div class="row">
						<ul class="nav nav-tabs">
							<li><a data-toggle="tab" href="#course_list">Course List</a></li>
							<li <?php echo (isset($_GET['tab']) && $_GET['tab'] == "completed") ? "" : "class='active'" ?> ><a data-toggle="tab" href="#current_classes">Current Classes</a></li>
							<li <?php echo (isset($_GET['tab']) && $_GET['tab'] == "completed") ? "class='active'" : "" ?> ><a data-toggle="tab" href="#completed_classes">Completed Classes</a></li>
						</ul>
					</div>

					<div class="row">
						<div class="tab-content">
							<div id="course_list" class="tab-pane fade">
								<?php
								foreach($courses->result() as $i => $c)
								{
									echo "<div class='col-md-4'>";
									echo "<div id='$c->code' class='panel course-panel ".($c->is_approved ? 'panel-info' : 'panel-default')."'>";
									echo "<div class='panel-heading'><div class='panel-title Title'>$c->code</div></div>";
									echo "<div class='panel-body'>
												<p><b>Title: </b> <span>$c->title</span></p>";
									echo $c->is_approved ? "<p><button class='btn btn-primary schedule-class-btn' data-toggle='modal' data-target='#add-class-modal' data-code='$c->code' data-title='$c->title' data-id='$c->id'>Schedule a Class</button></p>": "<p class='text-danger'>This course is not approved yet.</p>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
								?>
							</div>
							<div id="current_classes" class="tab-pane fade in <?php echo (isset($_GET['tab']) && $_GET['tab'] == "completed") ? "" : "active" ?>">
								<?php
									foreach($classes->result() as $i => $c)
									{
										echo "<div class='col-md-12'>";
										echo "<div class='panel course-panel ".($c->student_count == 0 ? 'panel-warning': ($c->started == 1 ? 'panel-info' : 'panel-default'))."'>";
										echo "<div class='panel-heading'>
														<div class='panel-title Title'>[$c->code] $c->title </div>														
													</div>";
										echo "<div class='panel-body'><div class='row'>
												<div class='col-md-6'>
													<div><b>Students Enrolled: </b><span class='badge badge-warning'>$c->student_count</span></div>
													<div><b>Group: </b> <span>$c->group</span></div>
													<div><b>Schedule: </b> <span>$c->schedule</span></div>
													<div><b>Status: </b> <span>".($c->started ? "<span class='label label-success my-label'>Class Started</span>" : "<span class='label label-warning my-label'>Not Yet Started</span> <a href='#' class='start-class' data-id='$c->int'>click to start class</a>")."</span></div>
												</div>
												<div class='col-md-6'>
													<div class='pull-right'>";
								if(!$c->started && $c->student_count == 0) {
									echo "<span  data-toggle='modal' data-target='#delete-class-modal' class='btn btn-danger btn-md remove-class-btn' data-id='$c->int'>REMOVE CLASS</span>";
								}
									if($c->student_count > 0){
										if($c->started) {
											echo "<a href='" . base_url("User/viewReports?cid=$c->int") . "' class='btn btn-success btn-md '>VIEW REPORT</a>";
										}
										echo "<a href='".base_url("User/inputGrades?cid=$c->int")."' class='btn btn-primary btn-md'>INPUT GRADES</a>";
									}
									echo "</div>
												</div>
												</div>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
									}
								?>
							</div>
							<div id="completed_classes" class="tab-pane fade in <?php echo (isset($_GET['tab']) && $_GET['tab'] == "completed") ? "active" : "" ?>">
								<?php
								foreach($completed->result() as $i => $c)
								{
									echo "<div class='col-md-12'>";
									echo "<div class='panel course-panel-completed panel-success'>";
									echo "<div class='panel-heading'>
														<div class='panel-title Title'>[$c->code] $c->title </div>														
													</div>";
									echo "<div class='panel-body'><div class='row'>
												<div class='col-md-6'>
													<div><b>Students Enrolled: </b><span class='badge badge-warning'>$c->student_count</span></div>
													<div><b>Group: </b> <span>$c->group</span></div>
													<div><b>Schedule: </b> <span>$c->schedule</span></div>
													<div><b>Report Submitted At: </b> <span>$c->submission_date</span></div>
													<div><b>Status: </b> <span>".($c->started ? "<span class='label label-default my-label'>Class Completed</span>" : "<span class='label label-warning my-label'>Not Yet Started</span> <a href='#' class='start-class' data-id='$c->int'>click to start class</a>")."</span></div>
												</div>
												<div class='col-md-6'>
													<div class='pull-right'>";
									echo "<a href='" . base_url("User/viewReports?cid=$c->int") . "' class='btn btn-success btn-md '>VIEW REPORT</a>";
									echo "</div>
												</div>
												</div>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
								?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="add-class-modal">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<h4 class="modal-title" id="class-modal-code">Add Class</h4>
						<h4 class="modal-title" id="class-modal-title">Title</h4>
					</div>
					<form id="add-class-form"  data-toggle="validator" role="form">
						<div class="modal-body">
							<div class="form-group">
								<p><input class="form-control" placeholder="Groupnumber" id="add-class-group" min="1" max="99" step="1" name="group" type="number" required ></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<p><input class="form-control" placeholder="Schedule" id="add-class-schedule"  name="schedule" pattern="[M,W,F,T,T,H,S]{1,4}[\-]([0-9]){1,4}(^|:)([0-9]){1,4}[\-]([0-9]){1,4}(^|:)([0-9]){1,4}" type="text"  data-error="Format Example: MW-7:30-10:30" required ></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<button id="import-csv-btn" class="form-control btn-sm btn-success"><i class="fa fa-upload"></i> Import Students List CSV</button>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group" style="display: none">
								<p><input class="form-control" id="import-students-csv" name="filename" type="file" accept=".csv" required ></p>
								<div class="help-block with-errors"></div>
							</div>

							<table id="class-student-table" class="table table-hover" style="display: none;">
								<thead>
									<tr>
										<th>#</th>
										<th>ID Number</th>
										<th>Student Name</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<div class="modal-footer">
								<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary confirm-add" id="modal-confirm-add">Create Class</button>
							</div>	 
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="delete-class-modal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
        		<h3>Are you sure?</h3>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id="confirm-delete-class">Delete</button>
					</div>
				</div>
			</div>
		</div>


	<script>
		var $doc = $(document);
		var studentList_id = [];
		var studentList_name = [];
		var classToDelete;

		var pageApp = {

			plotCSV: function(event){
				var fileArr = pageApp.csvToArray(event.target.result.replace(/"/g,''));

				$("#class-student-table > tbody tr").remove();
				for(var x=0; x < fileArr.length; x++){
					studentList_id.push(fileArr[x][0]);
					studentList_name.push(fileArr[x][2]+" "+fileArr[x][1]);
					$("#class-student-table > tbody").append("<tr>" +
						"<td>"+(x+1)+"</td>" +
						"<td>"+fileArr[x][0]+"</td>" +
						"<td>"+fileArr[x][2]+" "+fileArr[x][1]+"</td>" +
						"</tr>");
				}

				$("#class-student-table").show();
			},

			 deleteClass: function(){
			
				$.ajax({
					url: '<?php echo base_url('User/deleteClass')?>',
					type: 'POST',
					data: {cid: classToDelete},
					success: function(response){
						console.log(response);
						location.reload();
					}
				});
			 },

			csvToArray: function(csv){
				var lines=csv.split("\n");
				var result = [];

				lines.forEach(function(element){
					result.push(element.split(','));
				});
				return result;
			},

			events: function(){
				$doc.on('click','.start-class',function(){

					$.ajax({
						url: '<?php echo base_url('User/startClass');?>',
						type: 'POST',
						data: {cid: $(this).data('id')},
						success: function(response){
							console.log(response);
							location.reload();

							if(response.isOk){
								//change status and alter buttons, or refresh page.
							}
						}
					});
				});

				$doc.on('click','.remove-class-btn',function(){
					classToDelete = $(this).data('id');
				});

				$('#import-csv-btn').on('click',function(){
					$('#import-students-csv').click();
				});

				$('#import-students-csv').on('change',function(){
					var tempFile = $('#import-students-csv')[0].files[0];

					console.log(tempFile);
					if(window.FileReader){
						var fReader = new FileReader();
						fReader.readAsText(tempFile);
						fReader.onload = pageApp.plotCSV;
					}else{
						console.log('FileReader not supported');
					}
				});

				 $('#confirm-delete-class').on('click',	function () {
						pageApp.deleteClass();
				 });

				$('#modal-confirm-add').on('click',function(){
					var ajaxData = {
						course_id: $(this).data('id'),
						group: $('#add-class-group').val(),
						schedule: $('#add-class-schedule').val(),
						user_id: '<?php echo $this->session->userdata('id'); ?>',
						student_ids: studentList_id,
						student_names: studentList_name,
					};

					$.ajax({
						url: '<?php echo base_url('User/addClassSchedule'); ?>',
						type: 'POST',
						data: ajaxData,
						beforeSend: function(xhr){
							console.log(ajaxData);
						},
						success:function(response){
							console.log(response);
						}
					});
				});

					$('#add-class-form').validator().on('submit', function (e) {
						if (e.isDefaultPrevented()) {
							//Do nothing on invalid form
						} else {
							$('#add-class-modal').modal('hide');
							pageApp.addUser();
						}
					});				

				$doc.on('click','.schedule-class-btn', function(){
					$('#class-modal-code').text($(this).data('code'));
					$('#class-modal-title').text($(this).data('title'));
					$('#modal-confirm-add').data('id',$(this).data('id'));
				});

					$('#add-class-modal').on('hide.bs.modal', function(){
						$('#add-class-form').validator('destroy');
						$('#add-class-form').validator();
					});				

			},

			init: function(){
				pageApp.events();
			}
		};

		$doc.ready(function(){
			pageApp.init();
		});
	</script>

	</body>
</html>