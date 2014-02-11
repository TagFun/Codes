$(document).ready(function() {
	
	$("#testbutton, strong").click(function() {
		$("#third").css("color" , "red");
		$(this).css("background-color" , "grey");
	});
});