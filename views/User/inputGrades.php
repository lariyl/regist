<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Input Grades')); ?>
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
									echo "<div class='panel panel-primary'>";

									echo "<div class='panel-heading'>";
									echo "<h4 class='panel-title'>";
									echo "<a data-toggle='collapse' data-parent='#inputGradeAccordion' id='$c->int' data-target='#collapse$c->int'>[$c->code] $c->title <span class='badge'>$c->group</span></a>";
									echo "<a href='inputGrades' class='btn btn-success pull-right'>Save Grade</a>";
									echo "</h4>";
									echo "</div>";

									echo "<div id='collapse$c->int' class='panel-collapse collapse'>";
									echo "<div class='panel-body'>";

									echo "<table class='table'>";
									echo "<thead>
													<tr>
														<td>#</td>
														<td>ID Number</td>
														<td>Student Name</td>
														<td>Pre-Midterms</td>
														<td>Midterms</td>
														<td>Pre-Finals</td>
														<td>Finals</td>
														<td>Practicals</td>
														<td>Others</td>
													</tr>
												</thead>";
									echo "<tbody>";
									foreach($students->result() AS $x => $s){
										echo "<tr>
												<td>".($x+1)."</td>
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