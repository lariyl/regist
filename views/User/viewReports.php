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

				<div class="col-md-10 col-md-offset-2 main">
					<h3 align="center">OBTL Form 4</h3>
					<h5 align="center">Course Assessment Report</h5>
<!-- 					<p>Course Code & Title: </p>
					<p>Name of Program: BS Computer Engineering </p>
 -->					<table class="table table-bordered">
						<thead class="table">
							<tr>
								<th scope="col">Course Outcome</th>
								<th scope="col">Assesment Task</th>
								<th scope="col">Student's Level of Achievement of Outcome <br> (Frequency, Percentage) </th>
								<th scope="col">Target</th>
								<th scope="col">Gap</th>
							</tr>
						</thead>
						<tbody>
						    <tr align="center">
						      <td></td>
						      <td></td>
						      <td>1.0</td>
						      <td></td>						      
						    </tr>


						</tbody>   
					</table>	 
				</div>
			</div>
		</div>
	</body>
</html>


