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

	<div>
		<?php var_dump($evaluation); ?>
	</div>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isViewReports' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<h3 align="center">OBTL Form 4</h3>
					<h5 align="center">Course Assessment Report</h5>
					<p class="pull-left"><b>Course Code & Title:</b> CPE 01TN |  COMPUTER HARDWARE FUNDAMENTALS | Grp.1</p>
					<p align="right"><b>Name of Faculty: </b><a href="#" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
					<p class="pull-left"><b>Name of Program: </b>BS Computer Engineering</p>	
					<p align="right"><b>Term & AY: </b>Second Semester, AY 2016-2017</p>
					<table class="table table-bordered table table-responsive">
						<thead class="table">
							<tr>
								<th scope="col">Course Outcome</th>
								<th scope="col">Assesment Task</th>
								<th colspan="4" scope="col">Student's Level of Achievement of Outcome <br> (Frequency, Percentage)</th>
								<th scope="col">Target</th>
								<th scope="col">Gap</th>
							</tr>
						</thead>
						<tbody>
						    <tr align="center">
						    	<td></td>
						    	<td></td>			      
						    	<td><?php echo $evaluation['ranks']->pmr1; ?></td>
									<td><?php echo $evaluation['ranks']->pmr2; ?></td>
									<td><?php echo $evaluation['ranks']->pmr3; ?></td>
									<td><?php echo $evaluation['ranks']->pmr4; ?></td>
						    	<td></td>
						    	<td></td>			      
						    </tr>
						    <tr align="center">
						    	<td></td>
						    	<td></td>
									<td><?php echo $evaluation['ranks']->mr1; ?></td>
									<td><?php echo $evaluation['ranks']->mr2; ?></td>
									<td><?php echo $evaluation['ranks']->mr3; ?></td>
									<td><?php echo $evaluation['ranks']->mr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
						    	<td></td>			      
						    </tr>						
						        <tr align="center">
						    	<td></td>
						    	<td></td>
											<td><?php echo $evaluation['ranks']->pfr1; ?></td>
											<td><?php echo $evaluation['ranks']->pfr2; ?></td>
											<td><?php echo $evaluation['ranks']->pfr3; ?></td>
											<td><?php echo $evaluation['ranks']->pfr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
						    	<td></td>			      
						    </tr>				
						    <tr align="center">
						    	<td></td>
						    	<td></td>
									<td><?php echo $evaluation['ranks']->fr1; ?></td>
									<td><?php echo $evaluation['ranks']->fr2; ?></td>
									<td><?php echo $evaluation['ranks']->fr3; ?></td>
									<td><?php echo $evaluation['ranks']->fr4; ?></td>
						    	<td>80% of cohort with rating of 2.0 or better</td>
						    	<td></td>			      
						    </tr>
								<tr align="center">
									<td></td>
									<td></td>
									<td><?php echo $evaluation['ranks']->pr1; ?></td>
									<td><?php echo $evaluation['ranks']->pr2; ?></td>
									<td><?php echo $evaluation['ranks']->pr3; ?></td>
									<td><?php echo $evaluation['ranks']->pr4; ?></td>
									<td>80% of cohort with rating of 2.0 or better</td>
									<td></td>
								</tr>
								<tr align="center">
									<td></td>
									<td></td>
									<td><?php echo $evaluation['ranks']->or1; ?></td>
									<td><?php echo $evaluation['ranks']->or2; ?></td>
									<td><?php echo $evaluation['ranks']->or3; ?></td>
									<td><?php echo $evaluation['ranks']->or4; ?></td>
									<td>80% of cohort with rating of 2.0 or better</td>
									<td></td>
								</tr>
						</tbody>   
					</table>	 

					<div class="container-fluid">
						<p class="pull-left"><b>1.0 - Exceeds Expections</b> (evaluation of output may range from 1.0 to 1.4)</p>
						<p class="pull-right"><b>3.0 - Partially Meet Expecttions</b> (evaluation of output may range from 2.5 to 3.0)</p>
						<p class="pull-right"><b>4.0 - Does Not Meet Expecttions</b> (evaluation of output with a rating 3.0 or lower)</p>
						<p class="pull-left"><b>2.0 - Meets Expections</b> (evaluation of output may range from 1.5 to 2.4)</p>
					</div>

					<table class="table table-bordered" style="width: 25%;">
						<thead class="table">
							<tr>
								<td>Total No. of Students Enrolled:</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Number of Students Passed: <?php echo $evaluation['psc']; ?></td>
							</tr>
						</tbody>
					</table>


					<div class="container-fluid">
						<div class="row">
							<div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Continuos Quality Improvement</h3>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label for="data_interpretation"><u>Data Interpretation</u></label>
											<textarea class="form-control" rows="5" id="data_interpretation"></textarea>
										</div>
										<label for="improvement_action"><u>Propose Improvement Action</u></label>
										<h6>In order to increase the course's performance improvement actions are recommended:</h6>
										<div class="form-group">
										  <textarea class="form-control" rows="5" id="improvement_action"></textarea>
										</div>
									  	<div class="col-xs-4 pull-right">
											<label for="received_by">Received By:</label>
									    	<input class="form-control" id="received_by" class="submit_comments" type="text">
									  	</div>
										<div class="col-xs-2 pull-right">
											<label for="date_submitted">Date Submitted:</label>
									    	<input class="form-control" id="date_submitted" class="submit_comments" type="time">	
									  	</div>	  	
									</div>
								<button type="submit" class="btn btn-primary pull-right">Submit Report</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


