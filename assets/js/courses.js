$(document).ready(function(){

	//accordion box is collapsed on page load:
	$('#course_accordion').find('.course_title').next().hide();

	//when we click on an h4 heading in the accordion box:
	$('#course_accordion').find('.course_title').children('h4').click(function(){
		var title = $(this); // $(this) is the h4 element inside div!
		var title_bar = title.parent(); //the div with class='course_title'

		// closes all other tabs before toggling $(this) tab
		title_bar.siblings('.course_title').next().slideUp();
		title_bar.next().slideToggle();
	}).parent().next().hide();
	//NOTE: the '.parent().next().hide()' is saying:
	// First, get the parent of the 'h4' that was clicked, which is a div with a
	// class of 'course_title'.
	// find the 'next' element(s) of that parent (div with class='course_title')
	// hide those elements, if not hidden already

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