<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<p class="navbar-text navbar-left">Signed in as <a href="<?php echo base_url('/');?>" class="navbar-link"><?php echo $this->session->userdata('username'); ?></a></p>
		<a href="<?php echo base_url('auth/logout');?>"> <button type="button" class="btn btn-default navbar-btn pull-right navbar-buttons">Logout</button></a>

		<?php
		$changePassswordURL = base_url('user/changePassword');
		if($this->session->userdata('role') == 'user')
		{
			echo "<a href='$changePassswordURL'> <button type='button' class='btn btn-default navbar-btn pull-right navbar-buttons'>Change Password</button></a>";
		}
		?>
	</div>
</nav>