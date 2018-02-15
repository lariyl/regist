<!DOCTYPE html>
<html>
          <p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('auth/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Record Module</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>
		<?php $this->load->view('Partials/styles'); ?>
	</head>

<style>
body {
  margin: 0;
  background-color: #f1f1f1;
}

.sidebar {
    height: 100%;
    width: 200px;
    position: fixed;
    background-color: #111;
    padding-top: 100px;
}

</style>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="active"><a href="#">Manage Class</span></a></li>
						<li><a href="#">Input Grades</span></a></li>
						<li><a href="#">View Reports</span></a></li>
					</ul>
				</div>

				<div class="col-md-10 col-md-offset-2 main">
					<table class="table table-danger">
						<thead>
							<tr>
								<th>test</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>ioadjasljdoai</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</body>

</html>