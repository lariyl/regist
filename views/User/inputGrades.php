<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Input Grades')); ?>

		<style>
			.grades-table > thead{
				font-weight: bold;
				background-color: lightgrey;
				text-align: center;
				vertical-align: middle;	
			}
			.grades-table > tbody{
				font-size: .8em;
			}
			.courses-heading{
				cursor: pointer;
			}
			.grades-table thead tr td, .grades-table tbody tr td{
				vertical-align:middle;
			}
			.inline-btn{
				display: inline-block;
			}
			@media print{
				 .noprint {
				 	display:none !important;
				 }
				 .tablegrade{
				 	display: none !important;
				 }
				 .tarea{
				 	display: none !important;
				 }
			    }
			<?php 
				if(  isset($_GET['viewOnly']) && $_GET['viewOnly'] == 1){
					echo "input{ pointer-events:none;  }";
					echo ".print-btn{ display: inline-btn; }";
					echo ".save-grade-btn { display: none; }";
				}
				else{
					echo ".print-btn{ display: none; }";
				}
			?>
		</style>

		<script>
			
			var $doc = $(document);
			var currentSaveBtnClicked;

			$( document ).ready(function() {
				var tempArr = document.getElementsByClassName("form-control grade-field");
				for(i=0;i<tempArr.length;i++)
				{
					var temp = parseFloat(tempArr[i].value);
					tempArr[i].value = temp.toFixed(2);
				}
			});

			var pageApp = {
				events: function(){
					$doc.on('click',".print-btn",function(e){
						e.preventDefault();
						window.print();
					});	

					$doc.on('submit','.course-grades',function(e){
						e.preventDefault();

						var saveButton = $("#"+$(this).data('bid'));

						$.ajax({
							url: '<?php echo base_url('User/saveGrades')?>',
							type: 'POST',
							data: $(this).serialize(),
							beforeSend: function(){
								$(currentSaveBtnClicked).html("<i class='fa fa-spinner fa-spin'></i>");
							},
							success: function(response){


								saveButton.html("Saved");
								saveButton.switchClass('btn-primary','btn-success');
								saveButton.attr('disabled','disabled');
//								pageApp.restoreSaveButton(3,saveButton)
								console.log(response);
								location.reload();
							}
						});
					});

					$doc.on('click','.save-grade-btn', function(){
						currentSaveBtnClicked = this;
//						$(this).html("<i class='fa fa-spinner fa-spin'></i>");
					});

					$doc.on('change','.grade-field',function(){
						var saveButton = $("#"+$(this).data('bid'));
						saveButton.html("Save Grade");
						saveButton.switchClass('btn-success','btn-primary');
						saveButton.removeAttr('disabled');
					});
				},
				restoreSaveButton: function(secs, button){
					button.html("Saved ("+secs+")");
					for(var i=secs; i > 0; i--){
						setTimeout(1000);
						button.html("Saved ("+secs+")");
					}

					button.html("Save Grade");
					button.switchClass('btn-success','btn-primary');
					button.removeAttr('disabled');
				},
				evaluateGrades: function(){
					$.each($('.total-grade'), function(idx,element){
						var grade = (Number($(this).text() == 'NaN')) ? 0 :  Number($(this).text());
						if(grade >= 1 && grade <= 1.4){
							$(element).parent().parent().css('background-color','rgb(224,240,217)');
						}else if(grade > 1.4 && grade <= 2.4) {
							$(element).parent().parent().css('background-color','rgb(218,237,247)');
						}else if(grade > 2.4 && grade <= 3) {
							$(element).parent().parent().css('background-color','rgb(252,248,228)');
						}else if(grade > 3) {
							$(element).parent().parent().css('background-color','rgb(242,222,222)');
						}
					});
				},
				init: function(){
					pageApp.events();
					$doc.ready(function () {
						<?php
							if(isset($_GET['cid'])){
								$cid = $_GET['cid'];
								echo "$('#$cid').trigger('click');";
								echo "$('html, body').animate({scrollTop: $('#p$cid').offset().top - 40}, 500);";
							}
						?>
						pageApp.evaluateGrades();
					});
				}
			};

			pageApp.init();
		</script>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<p class="navbar-text navbar-left">Teacher :<?php echo $this->session->userdata('personname'); ?></p>
				<?php $this->load->view('Partials/sideBar',array('isInputGrades' => 'active')); ?>

				<div class="col-md-10 col-md-offset-2 main">
					<div class="row">
						<div class="panel-group" id="inputGradeAccordion">


							<?php
								foreach($classes->result() AS $i => $c){
									$wpm = $c->weight_premidterms;
									$wm = $c->weight_midterms;
									$wpf = $c->weight_prefinals;
									$wf = $c->weight_finals;
									$wp = $c->weight_practicals;
									$wo = $c->weight_others;

									$pwpm = number_format($wpm*100,2);
									$pwm = number_format($wm*100,2);
									$pwpf = number_format($wpf*100,2);
									$pwf = number_format($wf*100,2);
									$pwp = number_format($wp*100,2);
									$pwo = number_format($wo*100,2);

									echo "<div class='row' id='p$c->int'>";
									echo "<br />";
									echo "<form method='post' class='course-grades' id='cg-$c->int' data-id='$c->int' data-bid='gsb-$c->int'>";
									echo "<input type='hidden' name='courseClass' value='$c->int' />";
									echo "<div class='panel ".($c->student_count == 0 ? 'panel-warning': 'panel-info')."'>";

									echo "<div class='panel-heading'>";
									echo "<div class='row'>";
									echo "<div class='col-md-9 courses-heading' data-toggle='collapse' data-parent='#inputGradeAccordion' id='$c->int' data-target='#collapse$c->int'><h4><span class='badge'>Grp #$c->group $c->schedule</span>  <br /> [$c->code] $c->title</h4></div>";

									if($c->student_count > 0){
										echo "<div class='col-md-3'>
												<div class='pull-right'>
												<a href='".base_url("User/viewReports?cid=$c->int")."' class='btn btn-success btn-sm noprint inline-btn' >View Reports</a>
												<button type='submit' data-id='$c->int' id='gsb-$c->int' data-saved='0' class='btn btn-primary btn-sm save-grade-btn inline-btn' >Save Grade</button>
												<a href='#' class='btn btn-warning btn-sm print-btn noprint inline-btn'>Print</a>
												</div>
											  </div>";
									}

									echo "</div>";
									echo "</div>";

									echo "<div id='collapse$c->int' class='panel-collapse collapse'>";
									echo "<div class='panel-body table_resize'>";


									echo "<table class='table table-striped table-bordered grades-table'>";
									echo "<thead>
													<tr>
														<td></td>
														<td>ID #</td>
														<td>STUDENT NAME</td>";
									
									$exams = $this->UserModel->getCourseExams($c->course_id);

								
									foreach ($exams->result() as $e) {
										echo  "<td>".$e->exam_name." (".($e->weight*100)."%) </td>
											<input type='hidden'  class='tablegrade' name='examid[]' value='".$e->exam_id."' >";						
									}
																		


									echo "				<td>TOTAL</td>
													</tr>
												</thead>";
									echo "<tbody>";
									$xi = 0;
									foreach($students->result() AS $x => $s){
										if($s->cc_id == $c->cc_id)
										{
											$xi += 1;

											echo "<tr>
													<td>$xi</td>
													<td>$s->id
														<input type='hidden' class='form-control' name='studentid[]' value='$s->id' />
													</td>
													<td>$s->name</td>";
													$total = 0;
											foreach ($exams->result() as $ie=> $e) {
												
$mygrade = $this->db->query("SELECT grade FROM class_exam_scores WHERE exam_id = ".$e->exam_id." AND student_id = ".$s->id." AND class_id = ".$s->cc_id)->row();
$mygrade = isset($mygrade) ? $mygrade->grade : '';		

												if(isset($_GET['viewOnly']) &&  $_GET['viewOnly'] == 1){
													echo "<td><label>".($mygrade == 0 ? '' : $mygrade)."</label></td>";
												}else{
													echo  "<td><input type='number' tabindex='".($ie%count($exams->result()))."' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='exam_".$e->exam_id.$s->id."' 
			value='".($mygrade == 0 ? '' : $mygrade)."' /></td>";		
												}
												$total = $total + ($e->weight * $mygrade);
																
											}	

													// <td><input type='number' tabindex='1' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='premidterms[]' value='$s->grade_premidterms' /></td>
													// <td><input type='number' tabindex='2' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='midterms[]' value='$s->grade_midterms' /></td>
													// <td><input type='number' tabindex='3' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='prefinals[]' value='$s->grade_prefinals' /></td>
													// <td><input type='number' tabindex='4' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='finals[]' value='$s->grade_finals' /></td>
													// <td><input type='number' tabindex='5' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='practicals[]' value='$s->grade_practicals' /></td>
													// <td><input type='number' tabindex='6' class='form-control grade-field' data-bid='gsb-$c->int' step='0.01' min='1.00' max='5.00' name='others[]' value='$s->grade_others' /></td>	

											echo "
												<td><b class='total-grade' data-wpm='$c->weight_premidterms' data-wm=$c->weight_midterms'' data-wpf='$c->weight_prefinals' data-wf='$c->weight_finals' data-wp='$c->weight_practicals' data-wo='$c->weight_others tarea'>
														".number_format($total,2)."
													</b></td>
												</tr>";
										}
									}
									echo "</tbody>";
									echo "</table>";

									echo "</div>";
									echo "</div>";

									echo "</div>";
									echo "</form>";
									echo "</div>";
								}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>