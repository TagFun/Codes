$(document).ready(function() {
	$("h1").click(function() {
		$("h2").hide(1000, function() {
			$("h3").fadeOut(1000);	
		});
	});
});