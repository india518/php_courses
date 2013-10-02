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
<?php 	if($this->session->flashdata('error_messages') != NULL)
		{	?>
		<div id="error_messages" class="alert alert-block alert-error">
<?php 		foreach($this->session->flashdata('error_messages') as $error)
			{	?>
			<p><?= $error ?></p>
<?php		}	?>
		</div><!-- closes the alert block -->
<?php	}	?>
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
				<label class="control-label" for="course_description">Description:</label>
				<div class="controls">
					<textarea class="span3" rows="5" name="course_description" id="course_description" placeholder="Course Description"></textarea>
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
		<div id="course_accordion">
<?php 		foreach($courses as $course)
			{	?>
				<div class="course_title">
					<h4><?= $course->title ?></h4>
					<div class="title_bar">
						<form class="delete_course" action="courses/delete_course" method="post">
							<input type="hidden" name="course_id" value="<?= $course->id ?>" />
							<input type="submit" class="btn btn-danger" value="Delete Course" />
						</form>
						<form class="edit_course" action="courses/edit_course" method="post">
							<input type="hidden" name="course_id" value="<?= $course->id ?>" />
							<input type="submit" class="btn btn-primary" value="Edit Course" />
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
				<p id="course_id_<?= $course->id ?>"><?= $course->course_description ?></p>
<?php 		}	?>
		</div>
	</div>
</body>
</html>