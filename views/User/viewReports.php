<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - View Reports')); ?>
	</head>

<style>
th{
	text-align: center;
	background-color: slategrey;
}
</style>
	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isViewReports' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2">
					<h3 align="center">OBTL Form 4</h3>
					<h5 align="center">Course Assessment Report</h5>
					<br />
					<div class="well">
						<p class="pull-left"><b>Course Code & Title:</b> <?php echo $evaluation['tc']->course_code; ?> |  <?php echo $evaluation['tc']->course_title; ?> | Group# <?php echo $evaluation['tc']->class_group; ?></p>
						<p align="right"><b>Name of Faculty: </b><a href="#" class="navbar-link"><?php echo $this->session->userdata('personname'); ?></a></p>
						<p class="pull-left"><b>Name of Program: </b>BS Computer Engineering</p>
						<p align="right"><b>Term & AY: </b>Second Semester, AY 2016-2017</p>
					</div>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th scope="col">Course Outcome</th>
								<th scope="col">Assesment Task</th>
								<th colspan="4" scope="col">Student's Level of Achievement of Outcome <br> (Frequency, Percentage)</th>
								<th scope="col">Target</th>
								<th scope="col">Gap</th>
							</tr>
							<tr align="center">
								<th colspan="2"></th>
								<th>1.0</th>
								<th>2.0</th>
								<th>3.0</th>
								<th>4.0</th>
								<th colspan="2"></th>
							</tr>
						</thead>
						<tbody>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc)) : 0 ?>
						    	<td><?php echo $evaluation['tc']->course_outcome_1; ?></td>
						    	<td>Pre-Midterms Exam</td>
						    	<td><?php echo $evaluation['ranks']->pmr1; ?></td>
									<td><?php echo $evaluation['ranks']->pmr2; ?></td>
									<td><?php echo $evaluation['ranks']->pmr3; ?></td>
									<td><?php echo $evaluation['ranks']->pmr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or bette</td>
						    	<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_1; ?></td>
									<td>Midterms Exam</td>
									<td><?php echo $evaluation['ranks']->mr1; ?></td>
									<td><?php echo $evaluation['ranks']->mr2; ?></td>
									<td><?php echo $evaluation['ranks']->mr3; ?></td>
									<td><?php echo $evaluation['ranks']->mr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
									<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>						
						        <tr align="center">
											<?php $gap = (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc)) : 0 ?>
											<td><?php echo $evaluation['tc']->course_outcome_1; ?></td>
											<td>Pre-Finals Exam</td>
											<td><?php echo $evaluation['ranks']->pfr1; ?></td>
											<td><?php echo $evaluation['ranks']->pfr2; ?></td>
											<td><?php echo $evaluation['ranks']->pfr3; ?></td>
											<td><?php echo $evaluation['ranks']->pfr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
											<td><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>				
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_1; ?></td>
									<td>Finals Exam</td>
									<td><?php echo $evaluation['ranks']->fr1; ?></td>
									<td><?php echo $evaluation['ranks']->fr2; ?></td>
									<td><?php echo $evaluation['ranks']->fr3; ?></td>
									<td><?php echo $evaluation['ranks']->fr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
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
									<td>80% of cohort with rating of 2.0 or better</td>
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
									<td>80% of cohort with rating of 2.0 or better</td>
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
										<form>
										<div class="col-md-12">
											<div class="form-group">
												<label for="data_interpretation"><u>Data Interpretation</u></label>
												<textarea class="form-control" rows="5" id="data_interpretation" style="resize: vertical;"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<label for="improvement_action" data-toggle='modal' data-target='#suggest-user-modal' class='suggest-user'><u>Propose Improvement Action</u> <i class='fa fa-sticky-note' style="padding-left: 5px;"></i></label>
											<h6>In order to increase the course's performance improvement actions are recommended:</h6>

											<div class="form-group">
												<textarea class="form-control" rows="5" id="improvement_action" style="resize: vertical;"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<button class="pull-right btn btn-success">Submit Report</button>
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
				</div>
			</div>
		</div>
	</body>
</html>


