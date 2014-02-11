$(document).ready(function() {
	
	$("h1").mouseenter(function() {
		$(this).css("background-color", "red");
	});

	$("h1").mouseleave(function() {
		$(this).css("background-color", "yellow");
		$("*").unbind("mouseleave");
	});
});