$(document).ready(function(){

	//accordion box is collapsed on page load:
	$('#course_accordion').find('.course_title_bar').next().hide();

	//when we click on an h4 heading in the accordion box:
	$('#course_accordion').find('.course_title_bar').click(function(){
		var title_bar = $(this); // $(this) is the course_title_bar div!

		// close any opaen tabs before toggling $(this) tab:
		title_bar.siblings('.course_title_bar').next().slideUp();

		// open the tab we clicked:
		title_bar.next().slideToggle();
	}).next().hide();

	$('#cancel_form').click(function(){
		//$('#add_course').reset();	//WRONG
		// We can't use jQuery for .reset, need to use javascript:
		document.getElementById("add_course").reset();

		//get rid of any error messages that may be showing:
		$('#error_messages').html("").removeClass('alert alert-error');

	//	return false;	//turn off for enable_profiler
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