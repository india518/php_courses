<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Course List</title>
	<script type="text/javascript" src="<?= base_url() ?>/assets/js/jquery.1_10_2.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/assets/js/courses.js"></script>
	<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>/assets/css/mycss.css" rel="stylesheet" type="text/css">
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
		<form id="add_or_edit_course" class="form-horizontal span5" 
<?php 		if ($course_edit)
			{	?>
				action="update_course_form" 
<?php		}
			else
			{	?>
				action="courses/new_course_form" 
<?php		}	?>
				method="post">
			<div class="control-group">
				<div class="controls">
<?php 			if ($course_edit)
				{	?>
					<legend class="span3">Edit Course</legend>
<?php 			}
				else
				{	?>
					<legend class="span3">Add Course</legend>
<?php			}	?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="title">Title:</label>
				<div class="controls">
					<input class="span3" type="text" name="title" id="title" 
<?php 				if ($course_edit)
					{	?>
						value="<?= $course_edit->title ?>"
<?php				}
					else
					{	?>
						placeholder="Course Title"
<?php				}	?>
						/> <!-- closing the input tag -->
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="course_description">Description:</label>
				<div class="controls">
					<textarea class="span3" rows="5" name="course_description" id="course_description" 
<?php 				if ($course_edit)
					{	?>
						><?= $course_edit->course_description ?></textarea>
<?php				}
					else
					{	?>
						placeholder="Course Description"></textarea>
<?php				}	?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a id="cancel_form" href="<?= base_url() ?>" class="btn btn-danger">Cancel</a>
					<!-- include a hidden field for id, if we are editing: -->
<?php 				if ($course_edit)
					{	?>
						<input type="hidden" name="course_id" value="<?= $course_edit->id ?>" />
<?php				}	?>
					<button type="submit" class="btn btn-primary pull-right">
<?php 				if ($course_edit)
					{	?>
						Update Course
<?php				}
					else
					{	?>
						Add Course
<?php				}	?>
					</button>
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