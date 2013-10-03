$(document).ready(function(){

	//accordion box is collapsed on page load:
	$('.course_title_bar').next().hide();
	//
	// This operates the accordion box:
	//
	$(document).on('click', '.course_title_bar', function(){
		var title_bar = $(this); // $(this) is the course_title_bar div!

		// close any open tabs before toggling $(this) tab:
		title_bar.siblings('.course_title_bar').next().slideUp();

		// open the tab we clicked:
		title_bar.next().slideToggle();
	}).next().hide();

	//
	// This is for canceling the Add/Edit Course forms:
	//
	$('#cancel_form').click(function(){
		// We can't use jQuery for .reset(), need to use javascript:
		//document.getElementById("add_course").reset();
		
		//actually, there IS an alternate way, using jQuery:
		$('#title').val() = "";
		$('#course_description').val() = "";

		//get rid of any error messages that may be showing:
		$('#error_messages').html("").removeClass('alert alert-error');

		return false;
	});

	//
	// This is for deleting a course and removing it from the accordion:
	//
	$('.delete_course').submit(function(){
		var this_form = $(this);
		var course_id = this_form.children('input[type="hidden"]').val();

		$.post(
			this_form.attr("action"),
			this_form.serialize(),
			function(){	//we're deleting - no data to recieve from action
				$('#title_course_' + course_id).remove();
				$('#course_description_' + course_id).remove();
			},
			"json"
		);

		return false;
	});

	//
	// This is for displaying a selected course to edit:
	//
	$('.edit_course').submit(function(){
		// console.log($(this));
		var this_form = $(this);

		$.post(
			this_form.attr("action"),
			this_form.serialize(),
			function(data){
				console.log(data);
				var form = $('#add_or_edit_course');
				form.attr('action', "courses/update_course_form");
				//these are all elements inside the form:
				$('legend').text("Edit Course");
				$('#title').val(data['title']);
				$('#course_description').val(data['course_description']);
				$('#course_id').val(data['id']);
				// If there is a hidden input already, we want to remove it
				// (for instance, if we click 'edit' on one course, but then click
				// 'edit' on another course without submitting the form.)
				$('#hidden_edit_input').remove();
				// And now add back the hidden input for the current course
				$('#cancel_form').after("<input id='hidden_edit_input' type='hidden' name='course_id' value=" + data['id'] + " />");
				$('button').text("Update Course");
			},
			"json"
		);	
		return false;
	});

	//
	// This is for adding (or updating) a course to the app:
	//
	$('#add_or_edit_course').submit(function(){
		var this_form = $(this);
		console.log(this_form.attr("action"));

		$.post(
			this_form.attr("action"),
			this_form.serialize(),
			function(data){
				if (data['action'] == 'add'){ // add new course
					//close accordion tabs so that added one will be the only one open:
					$('.course_title_bar').next().hide();
					$("#course_accordion").append(data['html']);
				}
				else{ //data['action'] == 'update'
					$('#title_course_' + data['id']).html(data['html']['title']);
					$('#course_description_' + data['id']).html(data['html']['description']);
					//close all tabs
					$('.course_title_bar').next().hide();
					//open up the tab we just editted:
					$('#title_course_' + data['id']).click();
				} //end else
			},
			"json"
		);

		return false;
	});

});