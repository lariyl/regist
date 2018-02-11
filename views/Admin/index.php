<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THESIS - Admin Index Page</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>
	</head>

	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('admin/index');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
					<a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right">Logout</button></a>
				</div>
			</nav>

			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<table id="system-users-table" class="table">
							<thead>
								<tr>
									<th colspan="5"><a href="#"><i class="fa fa-plus-square" data-toggle="modal" data-target="#add-user-modal"> </i></a> System Users</th>
								</tr>
								<tr>
									<th>#</th>
									<th>Usernamne</th>
									<th>Email</th>
									<th>Role</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($fetchData->result() as $idx => $row){
									$n = $idx+1;
									echo "<tr>";
									echo "<td>$n</td>";
									echo "<td>$row->username</td>";
									echo "<td>$row->email</td>";
									echo "<td>$row->role</td>";
									echo "<td data-id='$row->id'><a href='#'><i class='fa fa-cog'></i></a></td>";
									echo "</tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>



		<!-- MODALS AREA -->
<!-- Add User Modal -->
<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url('admin/registerUser'); ?>">
          <p><input class="form-control" placeholder="Username" name="username" type="text" required></p>
          <p><input class="form-control" placeholder="E-mail" name="email" type="email" required></p>
          <p><input class="form-control" placeholder="Password" id="password" name="password" type="password" required></p>
          <p><input class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" type="password" required></p>
          <span id="confirmMessage" class="confirmMessage"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

	</body>
</html>
