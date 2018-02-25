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
					<div class="row">
						<ul class="nav nav-tabs">
							<li><a data-toggle="tab" href="#your_classes">Your Classes</a></li>
							<li class="active"><a data-toggle="tab" href="#course_list">Course List</a></li>
						</ul>
					</div>

					<div class="row">
						<div class="tab-content">
							<div id="your_classes" class="tab-pane fade">
								
							</div>
							<div id="course_list" class="tab-pane fade in active">
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
					<div class="modal-body">
						<div class="form-group">
							<p><input class="form-control" placeholder="Groupname" id="add-class-group" name="group" type="text" required ></p>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<p><input class="form-control" placeholder="Schedule" id="add-class-schedule" name="schedule" type="text" required ></p>
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

				$doc.on('click','.schedule-class-btn', function(){
					$('#class-modal-code').text($(this).data('code'));
					$('#class-modal-title').text($(this).data('title'));
					$('#modal-confirm-add').data('id',$(this).data('id'));
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