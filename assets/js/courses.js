$(document).ready(function(){

	//accordion box is collapsed on page load:
	$('#course_accordion').find('.course_title_bar').next().hide();

	//when we click on a title bar in the accordion box:
	$('#course_accordion').find('.course_title_bar').click(function(){
		var title_bar = $(this); // $(this) is the course_title_bar div!

		// close any opaen tabs before toggling $(this) tab:
		title_bar.siblings('.course_title_bar').next().slideUp();

		// open the tab we clicked:
		title_bar.next().slideToggle();
	}).next().hide();

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

	$('.delete_course').submit(function(){
		var this_form = $(this);
		var course_id = this_form.children('input[type="hidden"]').val();
		//alert(course_id);
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

	// $('#add_course').submit(function(){
	// 	var this_form = $(this);

	// 	$.post(
	// 		this_form.attr("action"),
	// 		this_form.serialize(),
	// 		function(data){
	// 			//to test function:
	// 			$("#course_accordion").append(data['html']);
	// 		},
	// 		"json"
	// 	);

	// 	return false;
	// });

});