<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - View Grades')); ?>

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
						<p class="title-header" style="text-align: center;"><b><u>Class Record</u></br> Course Assessment Report </p></b>						
						<!-- <legend>OBTL Form 4: <span>Course Assessment Report</span></legend> -->
					</div>
					<div class="well">
						<p class="pull-left"><b>Course Code & Title:</b> <?php echo $evaluation['tc']->course_code; ?> |  <?php echo $evaluation['tc']->course_title; ?> | Group# <?php echo $evaluation['tc']->class_group; ?></p>
						<p align="right"><b>Name of Faculty: </b><a href="#" class="navbar-link"><?php echo $this->session->userdata('personname'); ?></a></p>
						<p class="pull-left"><b>Name of Program: </b>BS Computer Engineering</p>
<!-- 						<p align="right"><b>Term & AY: </b>Second Semester, AY 2016-2017</p> -->
					</div>


					<div class="container-fluid">
						<div class="row">
							<div>
								<div class="panel panel-default" >


										<div class="col-md-12">
											<input type="hidden" name="cid" value="<?php echo $loopback_cid; ?>" />
											<?php
											if($evaluation['tc']->is_completed){
												echo "<span class='pull-right label label-default' style='font-size: 1em;'>Submitted at: ".$evaluation['tc']->submission_date."</span>";
												echo "<a href='#' class='btn btn-warning btn-md noprint' onclick='printReport()'>PRINT GRAde</a>";												
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
			function printReport() {
    			window.print();
			}
		</script>
	</body>
</html>


