$(document).ready(function(){

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