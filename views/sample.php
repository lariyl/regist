<html>


	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="http://davidstutz.de/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>


		<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="http://davidstutz.de/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	</head>

	<script>
		$(document).ready(function(){
			$("#course-list").multiselect({
				enableCaseInsensitiveFiltering: true
			});
		});

	</script>

	<body>

	<div>
		<h3>test area</h3>
		<select id="course-list" >
			<?php
			foreach($list_course as $idx => $lc)
			{
				echo "<option value='$lc->id'>$lc->subject</option>";
			}
			?>
		</select>
	</div>

	</body>

</html>