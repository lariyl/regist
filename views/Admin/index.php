<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('Partials/globalHead', array('title' => 'THESIS - Admin')); ?>
	</head>

	<body>
		<?php $this->load->view('Partials/navBar'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 main">
					<table id="system-users-table" class="table">
						<thead >
							<tr>
								<th colspan="4"><a href="#" data-toggle="modal" data-target="#add-user-modal"><i class="fa fa-plus-square"></i></a> System Users</th>
							</tr>
							<tr class="success">
								<th>Name</th>
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
								echo "<td>$row->personname</td>";
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


		<!-- MODALS AREA -->
		<div class="modal fade" id="add-user-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<h4 class="modal-title">Add User</h4>
					</div>
					<form id="add-user-form"  data-toggle="validator" role="form">
						<div class="modal-body">
							<div class="form-group">
								<p><input class="form-control" placeholder="Name" id="add-user-name" name="personname" type="text" required></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<p><input class="form-control" placeholder="Username" id="add-user-username" name="username" type="text" required ></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<p><input class="form-control" placeholder="E-mail" id="add-user-email" name="email" type="email" required></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">	
								<p><input class="form-control" placeholder="Password" id="add-user-password" name="password" type="password" required></p>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<p><input class="form-control" placeholder="Confirm Password" id="add-user-confirmpassword" data-match="#add-user-password" data-match-error="Password Don't Match" name="confirmpassword" type="password" required></p>
								<div class="help-block with-errors"></div>
							</div>
						</div>	
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary confirm-add" data-role='user'>Add as User</button>
							<button type="submit" class="btn btn-primary confirm-add" data-role='admin'>Add as Admin</button>
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
			var addMode = null;

			var pageApp = {
				addUser: function(){
					ajaxData = {
						username: $('#add-user-username').val(),
						name: $('#add-user-name').val(),
						email: $('#add-user-email').val(),
						password: $('#add-user-password').val(),
						role: addMode
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
								console.log(responseData.error);
								alert(responseData.error);
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
						addMode = $(this).data('role');
					});

					$('#confirm-delete-user').on('click',	function () {
						pageApp.deleteUser();
					});

					$('#add-user-form').validator().on('submit', function (e) {
						if (e.isDefaultPrevented()) {
							//Do nothing on invalid form
						} else {
							$('#add-user-modal').modal('hide');
							pageApp.addUser();
						}
					});
					$('#add-user-modal').on('show.bs.modal', function(){
						$('#add-user-username').val('');
						$('#add-user-name').val(''),
						$('#add-user-email').val('');
						$('#add-user-password').val('');
						$('#add-user-confirmpassword').val('');
					});

					$('#add-user-modal').on('hide.bs.modal', function(){
						$('#add-user-form').validator('destroy');
						$('#add-user-form').validator();
					});
				},

				init: function(){
					pageApp.pageEvents();
					$('#add-user-form').validator();
				}
			};

			pageApp.init();
		</script>
	</body>
</html>