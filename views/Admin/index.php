<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THESIS - Admin Index Page</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
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
									<th colspan="4"><a href="#" data-toggle="modal" data-target="#add-user-modal"><i class="fa fa-plus-square"></i></a> System Users</th>
								</tr>
								<tr class="success">
									<th>Usernamne</th>
									<th>Email</th>
									<th>Role</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($users->result() as $row){
									echo "<tr>";
									echo "<td>$row->username</td>";
									echo "<td>$row->email</td>";
									echo "<td>$row->role</td>";
									echo "<td>
												<a href='#' data-id='$row->id' data-toggle='modal' data-target='#delete-user-modal' class='delete-user'><i class='fa fa-trash'></i></a>
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
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<h4 class="modal-title">Add User</h4>
					</div>
					<form data-toggle="validator" role="form" data-disable="false">
						<div class="modal-body">
							<p><input class="form-control" placeholder="Username" id="add-user-username" name="username" type="text" required></p>
							<p><input class="form-control" placeholder="E-mail" id="add-user-email" name="email" type="email" required></p>
							<p><input class="form-control" placeholder="Password" id="add-user-password" name="password" type="password" required></p>
							<p><input class="form-control" placeholder="Confirm Password" id="add-user-confirmpassword" name="confirmpassword" type="password" required></p>
						</div>	
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary confirm-add" data-role='user' data-dismiss="modal">Add as User</button>
							<button type="submit" class="btn btn-primary confirm-add" data-role='admin' data-dismiss="modal">Add as Admin</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="delete-user-modal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
        		<h3>Are you sure?</h3>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id="confirm-delete-user">Delete</button>
					</div>
				</div>
			</div>
		</div>

		<!-- TAIL JS -->
		<script>
			var $doc = $(document);
			var currentUserID = null;
			var currentUserRowElement = null;

			$dummy = null;

			var pageApp = {
				addUser: function(role){
					ajaxData = {
						username: $('#add-user-username').val(),
						email: $('#add-user-email').val(),
						password: $('#add-user-password').val(),
						role: role
					};

					$.ajax({
						url: '<?php echo base_url('Admin/registerUser')?>',
						type: 'POST',
						data: ajaxData,
						success: function(response){
							var responseData = JSON.parse(response);
							console.log(responseData);
							if(responseData.isOk)
							{
								deleteButton = "<a href='#' data-id='"+responseData.id+"' data-toggle='modal' data-target='#delete-user-modal' class='delete-user'><i class='fa fa-trash'></i></a>"
								$('#system-users-table').append("<tr>" +
									"<td>"+ajaxData.username+"</td>" +
									"<td>"+ajaxData.email+"</td>" +
									"<td>"+ajaxData.role+"</td>" +
									"<td>"+deleteButton+"</td> " +
									"</tr>");
							}
							else
							{
								console.log('Failed to Register.');
								alert("Username is already taken");
							}
						}
					});
				},

				deleteUser: function(){
					$.ajax({
						url: '<?php echo base_url('Admin/deleteUser')?>',
						type: 'POST',
						data: {id: currentUserID},
						success: function(response){
							currentUserRowElement.remove();
							currentUserRowElement = null;
							currentUserID = null;
						}
					});
				},

				pageEvents: function() {
					$doc.on('click', '.delete-user', function () {
						currentUserID = $(this).data('id');
						currentUserRowElement = $(this).parent().parent();
						console.log(currentUserID);
					});

					$doc.on('click', '.confirm-add', function()	{
						pageApp.addUser($(this).data('role'));
					});

					$('#confirm-delete-user').on('click',	function () {
						pageApp.deleteUser();
					});
				},

				init: function(){
					pageApp.pageEvents();
				}
			};

			pageApp.init();
		</script>
	</body>
</html>
