<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THESIS</title>
		<?php echo getCSS(); ?>
		<?php echo getJS(); ?>
	</head>

	<body>
		<div class="container" style="margin-top:150px">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Login</h3>
						</div>
						<div class="panel-body">
							<?php
								$error_msg= $this->session->flashdata('error_msg');

								if($error_msg)
								{
									echo "<div class='alert alert-danger'> $error_msg</div>";
								}
							?>
							<form role="form" method="post" action="<?php echo base_url('auth/verifyLogin'); ?>">
								<p><input class="form-control" placeholder="Username" name="username" type="text" required></p>
								<p><input class="form-control" placeholder="Password" name="password" type="password" required></p>
								<p><input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login"></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

