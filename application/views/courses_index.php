<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Course List</title>
	<script type="text/javascript" src="assets/js/jquery.1_10_2.js"></script>
	<script type="text/javascript" src="assets/js/courses.js"></script>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/mycss.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper" class="container">
		<form id="add_course" class="form-horizontal span5" action="courses/process_course_form" method="post">
			<div class="control-group">
				<div class="controls">
					<legend class="span3">Add Course</legend>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="title">Title:</label>
				<div class="controls">
					<input class="span3" type="text" name="title" id="title" placeholder="Course Title" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="description">Description:</label>
				<div class="controls">
					<textarea class="span3" rows="5" name="description" id="description" placeholder="Course Description"></textarea>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a id="cancel_form" href="#" class="btn btn-danger">Cancel</a>
					<button type="submit" class="btn btn-primary pull-right">Add Course</button>
				</div>
			</div>
		</form> <!-- End of new course form -->
		<div class="clearfix"></div>
		<div id="course_list">
		</div>
	</div>
</body>
</html>