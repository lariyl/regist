<div class="col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li class="<?php echo isset($isManageClass) ? $isManageClass : ''; ?>"><a href="<?php echo base_url('User/manageClass'); ?>">Manage Class</span></a></li>
		<li class="<?php echo isset($isInputGrades) ? $isInputGrades : ''; ?>"><a href="<?php echo base_url('User/inputGrades'); ?>">Input Grades</span></a></li>
		<li class="<?php echo isset($isViewReports) ? $isViewReports : ''; ?>"><a href="<?php echo base_url('User/viewReports'); ?>">View Reports</span></a></li>
<!-- 		<li class="<?php echo isset($isPastClass)   ? $isPastClass : ''; ?>"><a href="<?php echo base_url('User/pastClass'); ?>">Past Class</span></a></li>	
 -->	</ul>
</div>