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
//								saveButton.html("Saved");
								saveButton.switchClass('btn-primary','btn-success');
								saveButton.attr('disabled','disabled');
								pageApp.restoreSaveButton(3,saveButton)
								console.log(response);
							}
						});
					});

					$doc.on('click','.save-grade-btn', function(){
						$(this).html("<i class='fa fa-spinner fa-spin'></i>");
					});

//					$doc.on('change','.grade-field',function(){
//						var saveButton = $("#"+$(this).data('bid'));
//						saveButton.html("Save Grade");
//						saveButton.switchClass('btn-success','btn-primary');
//						saveButton.removeAttr('disabled');
//					});
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
				init: function(){
					pageApp.events();
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
									echo "<form method='post' class='course-grades' id='cg-$c->int' data-id='$c->int' data-bid='gsb-$c->int'>";
									echo "<input type='hidden' name='courseClass' value='$c->int' />";
									echo "<div class='panel panel-info'>";

									echo "<div class='panel-heading'>";
									echo "<div class='row'>";
									echo "<div class='col-md-10 courses-heading' data-toggle='collapse' data-parent='#inputGradeAccordion' id='$c->int' data-target='#collapse$c->int'><h4>[$c->code] $c->title <span class='badge'>$c->group</span></h4></div>";
									echo "<div class='col-md-2'><div class='pull-right'><button type='submit' data-id='$c->int' id='gsb-$c->int' data-saved='0' class='btn btn-primary save-grade-btn'>Save Grade</button></div></div>";
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
														<td>PRE-MIDTERMS</td>
														<td>MIDTERMS</td>
														<td>PRE-FINALS</td>
														<td>FINALS</td>
														<td>PRACTICALS</td>
														<td>OTHERS</td>
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
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='premidterms[]' value='$s->grade_premidterms' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='midterms[]' value='$s->grade_midterms' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='prefinals[]' value='$s->grade_prefinals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='finals[]' value='$s->grade_finals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='practicals[]' value='$s->grade_practicals' /></td>
													<td><input type='number' class='form-control grade-field' data-bid='gsb-$c->int' step='.01' min='0.00' max='5.00' name='others[]' value='$s->grade_others' /></td>
												</tr>";
										}
									}
									echo "</tbody>";
									echo "</table>";

									echo "</div>";
									echo "</div>";

									echo "</div>";
									echo "</form>";
									echo "<br />";
								}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>