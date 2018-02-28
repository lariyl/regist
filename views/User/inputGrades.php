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
									echo "<div class='panel panel-info'>";

									echo "<div class='panel-heading'>";
									echo "<div class='row'>";
									echo "<div class='col-md-10 courses-heading'><h4 data-toggle='collapse' data-parent='#inputGradeAccordion' id='$c->int' data-target='#collapse$c->int'>[$c->code] $c->title <span class='badge'>$c->group</span></h4></div>";
									echo "<div class='col-md-2'><div class='pull-right'><a href='inputGrades' class='btn btn-primary'>Save Grade</a></div></div>";
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
													<td>$s->id</td>
													<td>$s->name</td>
													<td><input type='number' class='form-control' name='premidterms' value='$s->grade_premidterms' /></td>
													<td><input type='number' class='form-control' name='midterms' value='$s->grade_midterms' /></td>
													<td><input type='number' class='form-control' name='prefinals' value='$s->grade_prefinals' /></td>
													<td><input type='number' class='form-control' name='finals' value='$s->grade_finals' /></td>
													<td><input type='number' class='form-control' name='practicals' value='$s->grade_practicals' /></td>
													<td><input type='number' class='form-control' name='others' value='$s->grade_others' /></td>
												</tr>";
										}
									}
									echo "</tbody>";
									echo "</table>";

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
	</body>
</html>