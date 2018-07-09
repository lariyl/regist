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
			.table_results{
				background-color: rgb(55,123,181);
				color:white;
				text-align: center;
			}
			.table_resize,th,td,tr{
		    border:2px solid;
		    padding:5px 40px; 
		    height: 10px;
			}
			@media print{
				.title-header{
					display: block !important;
					text-align: center;
					font-size: 10px;
			    }
			    .well{
			    	font-size: 9px;
			    	padding: 0;
			    	margin: -1mm;
			    	border: none;
			    }
			    th{
				-webkit-print-color-adjust: exact !important;
				background-color: rgb(55,123,181);
				color:white;
				text-align: center;
				}
				.custom-header th{
					background-color: grey !important;
				}
				.custom-header{
					background-color: grey !important;
				}
				.custom-table, .custom-table th, .custom-table td{
					border: .5mm solid black !important;
				 }
				.custom-table th, .custom-table td{
					height: 1mm !important;
					padding: 0 !important;
					margin: 0 !important;
				 }
				.span-border{
					border: none !important;
				}
				.padding-none{
					padding: 0 !important;
				 }
				 .margin-long{
				 	height: 30mm;
				 }
				 .move-right{
				 	padding-right: 6mm;
				 }
				 .noprint {
				 	display:none;
				 }
			}
		</style>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('Partials/sideBar',array('isViewReports' => 'active')); ?>
				<div class="col-md-10 col-md-offset-2">
					<div id="top-header">
						<p class="title-header" style="text-align: center;">University of San Carlos</br> School of Engineering </p></br>
						<p class="title-header" style="text-align: center;"><b><u>OBTL Form 4</u></br> Course Assessment Report </p></b>						
						<!-- <legend>OBTL Form 4: <span>Course Assessment Report</span></legend> -->
					</div>
					<div class="well">
						<p class="pull-left"><b>Course Code & Title:</b> <?php echo $evaluation['tc']->course_code; ?> |  <?php echo $evaluation['tc']->course_title; ?> | Group# <?php echo $evaluation['tc']->class_group; ?></p>
						<p align="right"><b>Name of Faculty: </b><a href="#" class="navbar-link"><?php echo $this->session->userdata('personname'); ?></a></p>
						<p class="pull-left"><b>Name of Program: </b>BS Computer Engineering</p>
						<p align="right"><b>Term & AY: </b>Second Semester, AY 2016-2017</p>
					</div>
					<table class="table table-bordered table-responsive table_resize custom-table">
						<thead>
							<tr class="custom-header">
								<th class="table_results" rowspan="2" style="vertical-align: middle">Course Outcome</th>
								<th class="table_results" rowspan="2" style="vertical-align: middle">Assesment Task</th>
								<th class="table_results" colspan="4" >Student's Level of Achievement of Outcome <br> (Frequency, Percentage)</th>
								<th class="table_results" rowspan="2" style="vertical-align: middle">Target</th>
								<th class="table_results" rowspan="2" style="vertical-align: middle">Gap</th>
							</tr>
							<tr class="custom-header" align="center">

								<th class="table_results">1.0</th>
								<th class="table_results">2.0</th>
								<th class="table_results">3.0</th>
								<th class="table_results">4.0</th>

							</tr>
						</thead>
						<tbody>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pmr1 + $evaluation['ranks']->pmr2) / $evaluation['ranks']->sc)) : 0 ?>
						    	<td rowspan="4" style="vertical-align: middle"><?php echo $evaluation['tc']->course_outcome_1; ?></td>
						    	<td style="font-size: .8em">Pre-Midterms Exam</td>
						    	<td><?php echo $evaluation['ranks']->pmr1; ?></td>
									<td><?php echo $evaluation['ranks']->pmr2; ?></td>
									<td><?php echo $evaluation['ranks']->pmr3; ?></td>
									<td><?php echo $evaluation['ranks']->pmr4; ?></td>
						    	<td rowspan="6" style="vertical-align: middle">80% of cohort <br />with rating of 2.0 or better</td>
						    	<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->mr1 + $evaluation['ranks']->mr2) / $evaluation['ranks']->sc)) : 0 ?>

									<td style="font-size: .8em">Midterms Exam</td>
									<td><?php echo $evaluation['ranks']->mr1; ?></td>
									<td><?php echo $evaluation['ranks']->mr2; ?></td>
									<td><?php echo $evaluation['ranks']->mr3; ?></td>
									<td><?php echo $evaluation['ranks']->mr4; ?></td>

									<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>						
						        <tr align="center">
											<?php $gap = (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pfr1 + $evaluation['ranks']->pfr2) / $evaluation['ranks']->sc)) : 0 ?>

											<td style="font-size: .8em">Pre-Finals Exam</td>
											<td><?php echo $evaluation['ranks']->pfr1; ?></td>
											<td><?php echo $evaluation['ranks']->pfr2; ?></td>
											<td><?php echo $evaluation['ranks']->pfr3; ?></td>
											<td><?php echo $evaluation['ranks']->pfr4; ?></td>

											<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>				
						    <tr align="center">
									<?php $gap = (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->fr1 + $evaluation['ranks']->fr2) / $evaluation['ranks']->sc)) : 0 ?>

									<td style="font-size: .8em">Finals Exam</td>
									<td><?php echo $evaluation['ranks']->fr1; ?></td>
									<td><?php echo $evaluation['ranks']->fr2; ?></td>
									<td><?php echo $evaluation['ranks']->fr3; ?></td>
									<td><?php echo $evaluation['ranks']->fr4; ?></td>

									<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
						    </tr>
								<tr align="center">
									<?php $gap = (($evaluation['ranks']->pr1 + $evaluation['ranks']->pr2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->pr1 + $evaluation['ranks']->pr2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_2; ?></td>
									<td style="font-size: .8em">Practicals</td>
									<td><?php echo $evaluation['ranks']->pr1; ?></td>
									<td><?php echo $evaluation['ranks']->pr2; ?></td>
									<td><?php echo $evaluation['ranks']->pr3; ?></td>
									<td><?php echo $evaluation['ranks']->pr4; ?></td>

									<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
								</tr>
								<tr align="center">
									<?php $gap = (($evaluation['ranks']->or1 + $evaluation['ranks']->or2) / $evaluation['ranks']->sc < .8) ? (.8 - (($evaluation['ranks']->or1 + $evaluation['ranks']->or2) / $evaluation['ranks']->sc)) : 0 ?>
									<td><?php echo $evaluation['tc']->course_outcome_3; ?></td>
									<td style="font-size: .8em">Others</td>
									<td><?php echo $evaluation['ranks']->or1; ?></td>
									<td><?php echo $evaluation['ranks']->or2; ?></td>
									<td><?php echo $evaluation['ranks']->or3; ?></td>
									<td><?php echo $evaluation['ranks']->or4; ?></td>

									<td class="suggest"><?php echo round($gap*$evaluation['ranks']->sc).' ('.(round($gap*100,2)).'%)'; ?></td>
								</tr>
						</tbody>   
					</table>

					<div class="well ">
						<div class="row">
							<div class="col-md-12">
								<p class="pull-left"><b>1.0 - Exceeds Expectations</b> (evaluation of output may range from 1.0 to 1.4)</p>
								<p class="pull-right"><b>3.0 - Partially Meet Expectations</b> (evaluation of output may range from 2.5 to 3.0)</p>
								<p class="pull-right"><b>4.0 - Does Not Meet Expectations</b> (evaluation of output with a rating 3.0 or lower)</p>
								<p class="pull-left"><b>2.0 - Meets Expectations</b> (evaluation of output may range from 1.5 to 2.4)</p>
							</div>
						</div>
					</div>

					<table class="table table-bordered  table-responsive table_resize custom-table" style="border: 2px solid;">
						<thead>
							<tr>
								<th  rowspan="1" style="width: 38%"><b class="move-right">Total No. of Students Enrolled: <span class="label label-primary span-border" style="font-size: 1.1em"><?php echo $evaluation['ranks']->sc; ?></span></b></th>
								<th  colspan="3" >Required Attachments:</th>
							</tr>
						</thead>	
						<tbody>
							<tr>
								<td><b>Number of Students Passed: <span class="label label-primary span-border" style="font-size: 1.1em"> <?php echo $evaluation['tc']->passed; ?></span></b></td>						
								<td><i class="fa fa-square"></i> Class Record</td>
								<td><i class="fa fa-square"> Sample of Assessment Task Output</td>
								<td><i class="fa fa-square-o"> Others:</td>
							</tr>
							<tr>
							</tr>
						</tbody>
					</table>

					<div class="container-fluid">
						<div class="row">
							<div>
								<div class="panel panel-default" >
									<div class="panel-heading custom-header padding-none">
										<div class="row" >
											<div class="col-md-6">
												<h4>Continuos Quality Improvement</h4>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<form method="post" action="<?php echo base_url('User/submitReport'); ?>">
										<div class="col-md-12">
											<div class="form-group margin-long">
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
											<div class="form-group margin-long">
												<label for="improvement_action" data-toggle='modal' data-target='#suggest-user-modal' class='suggest-user'>
													<u>Propose Improvement Action</u> <br />
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
												echo "<a href='#' class='btn btn-warning btn-md noprint' onclick='printReport()'>PRINT REPORT</a>";												
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
					</div>
					</fieldset>
				</div>
			</div>
		</div>


		<script>
			$( document ).ready(function() {
				let arr = []
				let counter = 0
				let exam = ["In Pre-Midterms,","In Midterms,","In Pre-Finals,", "In Finals,", "In Practicals,", "In Others,"]
				let arrClassName = document.getElementsByClassName('suggest')
				let suggestion;
				for(let i=0; i<arrClassName.length;i++){
					temp = arrClassName[i].innerText
					let temp2 = temp.split(' ')
					let final = parseFloat(temp2[1].match(/-?(?:\d+(?:\.\d*)?|\.\d+)/)[0]);

					arr.push(final);
				}
				console.log(arr)
				arr.forEach(function(item){
						if(item == 0){
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +"the class performance for the class showed exemplary result.\t";
						}else if(item <= 20.00){
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +"some students may have difficulty in couping the lesson disccussed .\t";
						}else if(item <= 40.00){
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +"half of the students are having a hard time of the lesson.\t";
						}else if(item <= 60.00){
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +" most students may have difficulty in the lesson.\t";
						}else if(item <= 80.00){
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +"the class haven't reached the 80%.\t";
						}else{
							document.getElementsByClassName('form-control')[0].value += exam[counter] + " " +"the class haven't reached the 80%.\t";
						}					
					counter++;
				});
			});

			function printReport() {
    			window.print();
			}
		</script>
	</body>
</html>


