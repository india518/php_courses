$(document).ready(function(){

	//accordion box:
	$('#course_accordion').find('.course_title').next().hide();

				$('#course_accordion').find('.course_title').click(function(){
					// closes all other tabs before toggling $(this) tab
					$(this).siblings('.course_title').next().slideUp();
					$(this).next().slideToggle();
				}).next().hide();

	$('#cancel_form').click(function(){
		//$('#add_course').reset();	//WRONG
		// We can't use jQuery for .reset, need to use javascript:
		document.getElementById("add_course").reset();

		return false;
	});

	// $('#add_course').submit(function(){
	// 	var this_form = $(this);

	// 	$.post(
	// 		this_form.attr("action"),
	// 		this_form.serialize(),
	// 		function(data){
	// 			//to test function:
	// 			$("#course_list").prepend(data['html']);
	// 		},
	// 		"json"
	// 	);

	// 	return false;
	// });

});