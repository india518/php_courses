$(document).ready(function(){
	alert("hi");

	$('#add_course').submit(function(){
		var this_form = $(this);

		$.post(
			this_form.attr("action"),
			this_form.serialize(),
			function(data){
				//to test function:
				$("#course_list").prepend(data['html']);
			},
			"json"
		);

		return false;
	});

});