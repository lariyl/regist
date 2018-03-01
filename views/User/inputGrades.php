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
			.up{
				margin-left: 25px; 
			}

		</style>

		<script>
			var $doc = $(document);

			var pageApp = {
				events: function(){
					$doc.on('submit','.course-grades',function(e){
						e.preventDefault();

						var saveButton = $("#"+$(this).data('bid'));

						$.ajax({
							url: '<?php echo base_url('User/saveGrades')?>',
							type: 'POST',
							data: $(this).serialize(),
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
						$(this).html("<i class='fa fa-spinner fa-spin'></i>");
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
									echo "<div class='col-md-9 courses-heading' data-toggle='collapse' data-parent='#inputGradeAccordion' id='$c->int' data-target='#collapse$c->int'><h4><span class='badge'>Group #$c->group</span> [$c->code] $c->title</h4></div>";

									if($c->student_count > 0){
										echo "<div class='col-md-3'>
												<div class='pull-right'><button type='submit' data-id='$c->int' id='gsb-$c->int' data-saved='0' class='btn btn-primary save-grade-btn'>Save Grade</button></div>
												<a href='".base_url("User/viewReports?cid=$c->int")."' class='btn btn-success save-grade-btn up'>View Reports</a>
											  </div>";
									}

									echo "</div>";
									echo "</div>";

									echo "<div id='collapse$c->int' class='panel-collapse collapse'>";
									echo "<div class='panel-body'>";


									echo "<table class='table table-striped table-bordered grades-table'>";
									echo "<thead>
													<tr>
														<td></td>
														<td>ID #</td>
														<td>STUDENT NAME</td>
														<td>PRE-MIDTERMS <br /> ($pwpm%)</td>
														<td>MIDTERMS <br /> ($pwm%)</td>
														<td>PRE-FINALS <br /> ($pwpf%)</td>
														<td>FINALS <br /> ($pwf%)</td>
														<td>PRACTICALS <br /> ($pwp%)</td>
														<td>OTHERS <br /> ($pwo%)</td>
														<td>TOTAL</td>
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
													<td>$s->name</td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='premidterms[]' value='$s->grade_premidterms' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='midterms[]' value='$s->grade_midterms' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='prefinals[]' value='$s->grade_prefinals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='finals[]' value='$s->grade_finals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='practicals[]' value='$s->grade_practicals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='1.00' max='5.00' name='others[]' value='$s->grade_others' /></td>
													<td><b class='total-grade' data-wpm='$c->weight_premidterms' data-wm=$c->weight_midterms'' data-wpf='$c->weight_prefinals' data-wf='$c->weight_finals' data-wp='$c->weight_practicals' data-wo='$c->weight_others'>
														".(($s->grade_premidterms * $c->weight_premidterms) + ($s->grade_midterms * $c->weight_midterms) + ($s->grade_prefinals * $c->weight_prefinals) + ($s->grade_finals * $c->weight_finals) +($s->grade_practicals * $c->weight_practicals) +($s->grade_others * $c->weight_others))."
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