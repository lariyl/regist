<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - View Reports')); ?>

		<style>
			.my-fieldset{
				border: solid 1px rgb(55,123,181);
				margin:5px;
				margin-top:10px;
				padding: 20px;
				border-radius: 10px;
			}
			.my-fieldset > legend{
				background-color: rgb(55,123,181);
				color: white;
				padding: 5px;
				border-radius: 10px;
				text-align: center;
			}
			th{
				text-align: center;
				background-color: rgb(55,123,181);
				color:white;
			}
			@media print{
				.title-header{
					display: block !important;
					text-align: center;
					font-size: 8px;
			    }	
			}
		</style>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isViewReports' => 'active')); ?>
				<p class="title-header" style="display: none;">University of San Carlos</br> School of Engineering </p></br>
				<p class="title-header" style="display: none;"><b><u>OBTL Form 4</u></br> Course Assessment Report </p></b></br>
				<div class="col-md-10 col-md-offset-2">
					<fieldset class="my-fieldset">
						<legend>OBTL Form 4: <span>Course Assessment Report</span></legend>
					<div class="well">
						<p class="pull-left"><b>Course Code & Title:</b> <?php echo $evaluation['tc']->course_code; ?> |  <?php echo $evaluation['tc']->course_title; ?> | Group# <?php echo $evaluation['tc']->class_group; ?></p>
						<p align="right"><b>Name of Faculty: </b><a href="#" class="navbar-link"><?php echo $this->session->userdata('personname'); ?></a></p>
						<p class="pull-left"><b>Name of Program: </b>BS Computer Engineering</p>
						<p align="right"><b>Term & AY: </b>Second Semester, AY 2016-2017</p>
					</div>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th rowspan="2" style="vertical-align: middle">Course Outcome</th>
								<th rowspan="2" style="vertical-align: middle">Assesment Task</th>
								<th colspan="4" >Student's Level of Achievement of Outcome <br> (Frequency, Percentage)</th>
								<th rowspan="2" style="vertical-align: middle">Target</th>
								<th rowspan="2" style="vertical-align: middle">Gap</th>
							</tr>
							<tr align="center">

								<th>1.0</th>
								<th>2.0</th>
								<th>3.0</th>
								<th>4.0</th>

							</tr>
						</thead>
						<tbody>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc)) : 0 ?>
						    	<td rowspan="4" style="vertical-align: middle"><?php echo $evaluation['tc']->course_outcome_1; ?></td>
						    	<td>Pre-Midterms Exam</td>
						    	<td><?php echo $evaluation['ranks']->pmr1; ?></td>
									<td><?php echo $evaluation['ranks']->pmr2; ?></td>
									<td><?php echo $evaluation['ranks']->pmr3; ?></td>
									<td><?php echo $evaluation['ranks']->pmr4; ?></td>
						    	<td rowspan="6" style="vertical-align: middle">80% of cohort <br />with rating of 2.0 or better</td>
						    	<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc)) : 0 ?>

									<td>Midterms Exam</td>
									<td><?php echo $evaluation['ranks']->mr1; ?></td>
									<td><?php echo $evaluation['ranks']->mr2; ?></td>
									<td><?php echo $evaluation['ranks']->mr3; ?></td>
									<td><?php echo $evaluation['ranks']->mr4; ?></td>

									<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>						
						        <tr align="center">
											<?php $gap = (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc)) : 0 ?>

											<td>Pre-Finals Exam</td>
											<td><?php echo $evaluation['ranks']->pfr1; ?></td>
											<td><?php echo $evaluation['ranks']->pfr2; ?></td>
											<td><?php echo $evaluation['ranks']->pfr3; ?></td>
											<td><?php echo $evaluation['ranks']->pfr4; ?></td>

											<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>				
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc)) : 0 ?>

									<td>Finals Exam</td>
									<td><?php echo $evaluation['ranks']->fr1; ?></td>
									<td><?php echo $evaluation['ranks']->fr2; ?></td>
									<td><?php echo $evaluation['ranks']->fr3; ?></td>
									<td><?php echo $evaluation['ranks']->fr4; ?></td>

									<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>
								<tr align="center">
									<?php $gap = (($evaluation['ranks']->pr1 + $evaluation['ranks']->pr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pr1 + $evaluation['ranks']->pr2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_2; ?></td>
									<td>Practicals</td>
									<td><?php echo $evaluation['ranks']->pr1; ?></td>
									<td><?php echo $evaluation['ranks']->pr2; ?></td>
									<td><?php echo $evaluation['ranks']->pr3; ?></td>
									<td><?php echo $evaluation['ranks']->pr4; ?></td>

									<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
								</tr>
								<tr align="center">
									<?php $gap = (($evaluation['ranks']->or1 + $evaluation['ranks']->or2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->or1 + $evaluation['ranks']->or2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_3; ?></td>
									<td>Others</td>
									<td><?php echo $evaluation['ranks']->or1; ?></td>
									<td><?php echo $evaluation['ranks']->or2; ?></td>
									<td><?php echo $evaluation['ranks']->or3; ?></td>
									<td><?php echo $evaluation['ranks']->or4; ?></td>

									<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
								</tr>
						</tbody>   
					</table>

					<table class="table table-bordered">
						<tbody>
							<tr>
								<td style="text-align: center"><b>Total No. of Students Enrolled: <span class="label label-primary" style="font-size: 1.1em"><?php echo $evaluation['ranks']->sc; ?></span></b></td>
								<td style="text-align: center"><b>Number of Students Passed: <span class="label label-primary" style="font-size: 1.1em"> <?php echo $evaluation['tc']->passed; ?></span></b></td>
							</tr>
						</tbody>
					</table>

					<div class="well">
						<div class="row">
							<div class="col-md-12">
								<p class="pull-left"><b>1.0 - Exceeds Expectations</b> (evaluation of output may range from 1.0 to 1.4)</p>
								<p class="pull-right"><b>3.0 - Partially Meet Expectations</b> (evaluation of output may range from 2.5 to 3.0)</p>
								<p class="pull-right"><b>4.0 - Does Not Meet Expectations</b> (evaluation of output with a rating 3.0 or lower)</p>
								<p class="pull-left"><b>2.0 - Meets Expectations</b> (evaluation of output may range from 1.5 to 2.4)</p>
							</div>
						</div>
					</div>


					<div class="container-fluid">
						<div class="row">
							<div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">
												<h4>Continuos Quality Improvement</h4>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<form method="post" action="<?php echo base_url('User/submitReport'); ?>">
										<div class="col-md-12">
											<div class="form-group">
												<label for="data_interpretation"><u>Data Interpretation</u></label>
												<?php
													if($evaluation['tc']->is_completed){
														echo "<div class='well'><p>".$evaluation['tc']->interpretation."</p></div>";
													}else{
														echo "<textarea class='form-control' rows='5' id='data_interpretation' style='resize: vertical;' name='interpretation'></textarea><br />";
													}
												?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="improvement_action" data-toggle='modal' data-target='#suggest-user-modal' class='suggest-user'>
													<u>Propose Improvement Action</u> <i class='fa fa-sticky-note' style="padding-left: 5px;"></i> <br />
													<span style="font-size: .8em; font-weight: normal;">In order to increase the course's performance improvement actions are recommended</span>
												</label>
												<?php
													if($evaluation['tc']->is_completed){
														echo "<div class='well'><p>".$evaluation['tc']->improvement_proposal."</p></div>";
													}else{
														echo "<textarea class='form-control' rows='5' id='improvement_action' style='resize: vertical;' name='improvement_proposal'></textarea><br />";
													}
												?>
												
											</div>
										</div>
										<div class="col-md-12">
											<input type="hidden" name="cid" value="<?php echo $loopback_cid; ?>" />
											<?php
											if($evaluation['tc']->is_completed){
												echo "<span class='pull-right label label-default' style='font-size: 1em;'>Submitted at: ".$evaluation['tc']->submission_date."</span>";
											}else{
												echo "<button class='pull-right btn btn-success' type='submit'>Submit Report</button>";
											}
											?>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
							<div class="modal fade" id="suggest-user-modal">
									<div class="modal-dialog modal-md">
										<div class="modal-content">
											 <div class="modal-header">
										        <h5 class="modal-title">Suggestion</h5>
										      </div>
										      <div class="modal-body">
										        <p>Add or Consider teaching - learning Activities.</p>
										        <p>Add more learning Activities.</p>
										       	<p>Revisit Syllabus</p>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										      </div>
										</div>
									</div>
								</div>
					</div>
					</fieldset>
				</div>
			</div>
		</div>
	</body>
</html>


