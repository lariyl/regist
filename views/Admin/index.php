<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THESIS - Admin Index Page</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>

		<style>
			.dropdown-menu li{
				padding: 5px;
				width: auto;
				cursor: pointer;
			}
			.dropdown-menu li:hover{
				background-color: rgb(248,248,248);
			}
		</style>
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
							<thead >
								<tr>
									<th colspan="5"><a href="#" data-toggle="modal" data-target="#add-user-modal"><i class="fa fa-plus-square"></i></a> System Users</th>
								</tr>
								<tr class="success">
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
									echo "<td>
											<div class='dropdown'>
												<a href='#' data-toggle='dropdown'><i class='fa fa-cog'></i></a>
												<ul class='dropdown-menu'>
													<li class='user-edit' data-id='$row->id'><i class='fa fa-pencil'></i> Edit</li>
													<li class='user-delete' data-id='$row->id'><i class='fa fa-trash'></i> Delete</li>
												</ul>
											</div>
										</td>";
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

		<div class="modal fade" id="add-user-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

					</div>
					<div class="modal-body">
						<form action="#">

						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="edit-user-modal">

		</div>

		<div class="modal fade" id="delete-user-modal">

		</div>


	</body>
</html>
