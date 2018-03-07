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
			.btn-md{
				margin-left: 5px; 
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
							<li class="active"><a data-toggle="tab" href="#your_classes">Your Classes</a></li>
							<li><a data-toggle="tab" href="#course_list">Course List</a></li>
						</ul>
					</div>

					<div class="row">
						<div class="tab-content">
							<div id="your_classes" class="tab-pane fade in active">
								<?php
									foreach($classes->result() as $i => $c)
									{
										echo "<div class='col-md-12'>";
										echo "<div class='panel course-panel ".($c->student_count == 0 ? 'panel-warning': 'panel-info')."'>";
										echo "<div class='panel-heading'>
														<div class='panel-title Title'>[$c->code] $c->title </div>
														<div><b>Students Enrolled: </b><span class='badge badge-warning'>$c->student_count</span> <a href='#' class='btn btn-danger btn-md'>DELETE CLASS</a></div>
													</div>";
										echo "<div class='panel-body'><div class='row'>
												<div class='col-md-6'>
													<p><b>Group: </b> <span>$c->group</span></p>
													<p><b>Schedule: </b> <span>$c->schedule</span></p>
												</div>
												<div class='col-md-6'>
													<div class='pull-right'>";
									if($c->student_count > 0){
										// echo "<a href='#' class='btn btn-danger btn-md'>DELETE CLASS</a>";
										echo "<a href='".base_url("User/viewReports?cid=$c->int")."' class='btn btn-success btn-md '>VIEW REPORTS</a>";
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
							<div id="course_list" class="tab-pane fade ">
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


	<script>
		var $doc = $(document);
		var studentList_id = [];
		var studentList_name = [];

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

			csvToArray: function(csv){
				var lines=csv.split("\n");
				var result = [];

				lines.forEach(function(element){
					result.push(element.split(','));
				});
				return result;
			},

			events: function(){
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